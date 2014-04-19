function addPost(data) {
  var post = $('<div>').addClass('post');
  post.append($('<h1>').html(data.title));
  post.append($('<div>').addClass('post-body').html(data.body));
  $('#post-holder').append(post);
}

$(window).on('load', function() {
  var boardNumber = 1;
  function addBoard() {
    var activeBoards = $('#active-boards h1').eq(0).html();
    if(activeBoards === "No boards selected"){
      $('#active-boards').html("");
    }
    $('#active-boards').append('<h1 class="board-' + boardNumber  + '" >' + $('#board-search')[0].value + '</h1>');
    $('#active-boards h1').on('click', function() {
      $(this).animate(
        {
          opacity: '0'
        },
        200,
        function() {
          $(this).remove();
         }
      );

    });
    boardNumber++;
    $('#board-search')[0].value = "";
  };
  $('#board-search').autocomplete({source: ["videogames", "darksouls", "pics", "random", "programming", "shelby", "mtg"]});
  $('#board-search').keypress(function(event){
    if ( event.which == 13 ) {
      event.preventDefault();
      addBoard();
    }
  });
  $('#board-add').on('click', addBoard);
  for(var i = 0; i < 20; i++)
    addPost({title: 'Post 1', body: '<p>test test test</p>'});
});
