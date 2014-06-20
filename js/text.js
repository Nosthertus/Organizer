
$(document).ready(function(){
	$.ionSound({
    sounds: [                       // set needed sounds names
        "chatAlert"
    ],
    path: "../Misc/Sound/",                // set path to sounds
    multiPlay: false               // playing only 1 sound at once
  //  volume: "0.3"                   // not so loud please
});
	$(window).resize(function() {
		window.scrollTo(0, document.body.scrollHeight);
	});

	$('#Message').keypress(function (event) {
		if (event.keyCode == 13 && !event.shiftKey) {
			send();
			return false;
		}
	});
});

function sound(){
	$.ionSound.play("chatAlert");
}

function getCaret(el) {
  if (el.selectionStart) {
     return el.selectionStart;
  } else if (document.selection) {
     el.focus();

   var r = document.selection.createRange();
   if (r == null) {
    return 0;
   }

    var re = el.createTextRange(),
    rc = re.duplicate();
    re.moveToBookmark(r.getBookmark());
    rc.setEndPoint('EndToStart', re);

    return rc.text.length;
  }  
  return 0;
}

$('textarea').keyup(function (event) {
   if (event.keyCode == 13 && event.shiftKey) {
       var content = this.value;
       var caret = getCaret(this);
       this.value = content.substring(0,caret)+
                     "\n"+content.substring(caret,content.length);
       event.stopPropagation();

  }
 });

$(document).delegate('#Message', 'keydown', function(e) {
  var keyCode = e.keyCode || e.which;

  if (keyCode == 9) {
    e.preventDefault();
    var start = $(this).get(0).selectionStart;
    var end = $(this).get(0).selectionEnd;

    // set textarea value to: text before caret + tab + text after caret
    $(this).val($(this).val().substring(0, start)
                + "\t"
                + $(this).val().substring(end));

    // put caret at right position again
    $(this).get(0).selectionStart =
    $(this).get(0).selectionEnd = start + 1;
  }
});