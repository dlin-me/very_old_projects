<!--

var pic = new Array(
 "images/attention.jpg",
 "images/bg.gif",
 "images/bg_left.gif",
 "images/bg_right.gif",
 "images/but_chinese.gif",
 "images/but_contacts.gif",
 "images/but_home.gif",
 "images/but_news.gif",
 "images/but_products.gif",
 "images/b_go2.gif",
 "images/defaultnew.gif",
 "images/dot_g.gif",
 "images/dot_w.gif",
 "images/e01.gif",
 "images/e02.gif",
 "images/e03.gif",
 "images/fon01.gif",
 "images/fon02.gif",
 "images/fon_bot.gif",
 "images/fon_r01.gif",
 "images/fon_r02.gif",
 "images/hr01.gif",
 "images/hr02.gif",
 "images/hr03.gif",
 "images/increase.gif",
 "images/kunming.jpg",
 "images/main01.jpg",
 "images/main01_bk.jpg",
 "images/mic.jpg",
 "images/news_image.gif",
 "images/px1.gif",
 "images/regulate.jpg",
 "images/separator.gif",
 "images/temp01.gif",
 "images/separator.gif",
 "images/temp01.jpg",
 "images/title01.gif",
 "images/title02.gif",
 "images/top.jpg",
 "images/top01.gif",
 "images/top02.gif" );
 
var loaded=1;
document.write("<center><div>")

for (var i=1; i<=pic.length; i++){
    document.write("<img id='img"+i+"' alt='-' " + 
	             "width='4' height='0' onload=\"this.style.borderTop='5px solid green'\" />");
    	
} 
document.write("</div>"+"<p>Preloading page gives more comfort when surfing this website</p>"+
                    "<p>[<a href='index.php'>Skip</a>]</p></center>");

function imageload() {
    var t = new Image();
	var u = new Image();

	
    t.src = pic[loaded];
	u.src = pic[loaded+1];

	document.getElementById('img'+loaded).src=t.src;
    document.getElementById('img'+(loaded+1)).src=u.src;

	
    t.onload = function () {
        loaded+=2;
		document.getElementById('per').innerHTML= Math.round(loaded*100/(pic.length));
		imageload();
	}

}

if (document.images){
  imageload();
}



//-->