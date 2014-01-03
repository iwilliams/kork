<?php

/*
 * This is the database class made for interacting with the databases.
 * If you need to get posts or users or any other action that involves
 * the database, you create an instance of this class and then call it's
 * methods.
 *
 *
 */

class Database {

    private $connection;

    /**
     * When the db object is constructed initialize the initial connection as either a mysql or psql object.
     * @todo Error for psql
     */
    public function __construct() {
        if (DB_MYSQL) {
            $this -> connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB) or die('Fatal Error: ' . mysqli_error($this -> connection));
        } else if (DB_PSQL) {
            $this -> connection = pg_connect('host=' . PSQL_HOST . ' port= dbname=' . PSQL_DB . ' user=' . PSQL_USER . ' password=' . PSQL_PASSWORD);
        }
    }

    /**
     * When the database object is no longer being referenced the destruct function will be called. This closes the db connection so you don't have
     * to do it manually every time.
     */
    public function __destruct() {
        if (DB_MYSQL) {
            mysqli_close($this -> connection) or die("Error clossing MYSQL Connection<br />MYSQL ERROR: " . mysqli_error($this -> connection));
        } else if (DB_PSQL) {
            pg_close($this -> connection) or die("Error clossing PSQL Connection<br />PSQL ERROR: " . pg_errormessage($this -> connection));
        }
    }

    /**
     * @todo Basically all of it.
     */
    public function getBoard() {
        return $this -> getBoards();
    }

    /**
     * @todo Add options implementation.
     * @todo Add PSQL implementation.
     */
    public function getBoards(array $optionsIn = null) {

        static $defaultOptions = array('' => '');

        if (!empty($optionsIn)) {
            $options = array_merge($defaultOptions, $optionsIn);
        } else {
            $options = $defaultOptions;
        }

        $boards = array();
        if (DB_MYSQL) {
            if ($result = mysqli_query($this -> connection, 'SELECT * FROM boards')) {
                while ($row = $result -> fetch_row()) {
                    array_push($boards, new Board($row[0], $row[1], $row[2], $this -> getPosts()));
                }
                mysqli_free_result($result);
            }
        } else if (DB_PSQL) {

        }

        return $boards;
    }

    /**
     * Returns one post who's id matches $idIn. Is this needed?  
     *
     * @todo Add support for options other than id?
     */
    public function getPost($idIn) {
        $posts = $this -> getPosts(array('id' => $idIn));
        return $posts[0];
    }

    /**
     * Returns all posts conforming to the constraints set in the options array.
     * If no options are set, will return all posts sorted by submission date in
     *
     * @return array Post[]
     * @todo add PSQL implementation
     * @todo add options implementation
     */
    public function getPosts(array $optionsIn = null) {

        static $defaultOptions = array();

        if (!empty($optionsIn)) {
            $options = array_merge($defaultOptions, $optionsIn);
        } else {
            $options = $defaultOptions;
        }

        $query = 'SELECT * FROM posts';

        /*
         * Adding to the query based on the options present. Don't know when exactly to add
         * "WHERE" to the query. Should probably check for its presence in the query string
         * and add if a previous option has not yet.
         */

        // ID Options. Can return posts based on id or array of ids.
        if (!empty($options['id'])) {
            $query .= ' WHERE ';
            if (is_array($options['id'])) {
                for ($i = 0; $i < sizeof($options['id']); $i++) {
                    $query .= 'id=' . $options['id'][$i];
                    if ($i !== sizeof($options['id']) - 1) {
                        $query .= ' OR ';
                    }
                }
            } else {
                $query .= 'id=' . $options['id'];
            }
        }

        $posts = array();
        if (DB_MYSQL) {
            if ($result = mysqli_query($this -> connection, $query)) {
                while ($row = $result -> fetch_row()) {
                    array_push($posts, new Post($row[0], $row[1], $row[2], $row[3]));
                }
                mysqli_free_result($result);
            }
        } else if (DB_PSQL) {

        }
        return $posts;
    }

    /**
     * This function is used for saving only one post to the database. It simply
     * calls the savePosts method with $post as the arrays only element.
     *
     * @param Post $post post to be saved into the database
     */
    public function savePost($post) {
        $this -> savePosts(array($post));
    }

    /**
     * This function is used for saving an array of posts to the database.
     *
     * @param array $posts posts to be saved into the database
     * @todo Finish PSQL implemention.
     */
    public function savePosts($posts) {
        foreach ($posts as $post) {
            if ($this -> postExists($post)) {
                $template = 'UPDATE posts SET title="%s", author="%s", content="%s" WHERE id=%d';
                $query = sprintf($template, $post -> getTitle(), $post -> getAuthor(), $post -> getContent(), $post -> getId());
            } else {
                $template = 'INSERT INTO posts (title, author, content) VALUES ("%s", "%s", "%s")';
                $query = sprintf($template, $post -> getTitle(), $post -> getAuthor(), $post -> getContent());
            }
            if (DB_MYSQL) {
                $this -> connection -> query($query) or die('Error Saving Post with id: ' . $post -> getId() . '<br/>MYSQL ERROR: ' . mysqli_error($this -> connection));
                if ($this -> connection -> insert_id) {
                    $post -> setId($this -> connection -> insert_id);
                }
            } else if (DB_PSQL) {
                pg_query($this -> connection, $query);
            }
        }
    }

    /**
     * This function is used for saving only one board to the database. It simply
     * calls the saveBoards method with $board as the arrays only element.
     *
     * @todo Should this method also save the children?
     * @param Board $board board to be saved into the database
     */
    public function saveBoard($board) {
        $this -> saveBoards(array($board));
    }

    /**
     * This function is used for saving an array of boards to the database.
     *
     * @param array $boards boards to be saved into the database
     */
    public function saveBoards($boards) {
        foreach ($boards as $board) {
            if ($this -> boardExists($board)) {
                $template = 'UPDATE boards SET title="%s", description="%s" WHERE id=%d';
                $query = sprintf($template, $board -> getTitle(), $board -> getDescription(), $board -> getId());
            } else {
                $template = 'INSERT INTO boards (title, description) VALUES ("%s", "%s")';
                $query = sprintf($template, $board -> getTitle(), $board -> getDescription());
            }
            if (DB_MYSQL) {
                $this -> connection -> query($query) or die('Error Saving Board with id: ' . $board -> getId() . '<br/>MYSQL ERROR: ' . mysqli_error($this -> connection));
            } else if (DB_PSQL) {
                pg_query($this -> connection, $query);
            }
        }
    }

    /**
     * Determines whether or not @post exists by querying the database for it's id
     *
     * @param Post $post The post to check for
     * @todo add PSQL implementation
     */
    public function postExists($post) {
        if (DB_MYSQL) {
            if (mysqli_num_rows(mysqli_query($this -> connection, 'SELECT * FROM posts WHERE id=' . $post -> getId())) > 0) {
                return true;
            }
        } else if (DB_PSQL) {
            //Add PSQL 
        }
        return false;
    }

    /**
     * Determines whether or not @board exists by querying the database for it's id
     *
     * @param Board $board The board to check for
     * @todo add PSQL implementation
     * @todo is ID the only thing we want to check for? Title's should be unique as well.
     */
    public function boardExists($board) {
        if (DB_MYSQL) {
            if (mysqli_num_rows(mysqli_query($this -> connection, 'SELECT * FROM boards WHERE id=' . $board -> getId())) > 0) {
                return true;
            }
        } else if (DB_PSQL) {

        }
        return false;
    }

}
?>