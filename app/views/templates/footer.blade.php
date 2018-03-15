<div id="goTotop">
<button type="button" class="btn btn-default btn-lg" id="top">
    <span class="glyphicon glyphicon-chevron-up"></span>
</button>
<script type="text/javascript">
    $(function () {
        $(window).scroll(function () {
            if ($(window).scrollTop() > 103) {
                $('#top').css('display','block');    //<div id-'top'></div>假如有这么个div是那个向上图标的div。css默认none
            }
            else {
                $('#top').css('display','none');
            };
            $("#top").click(function() {
                window.scroll(0,0);
            });
        });
    });
</script>
</div>
<div id="footer">
     <div class="footer">
  <p class="container text-center">
            Copyright &copy;<a href="http://bioinfo.life.hust.edu.cn/" target=_blank> Guo Lab</a>,<a href="http://life.hust.edu.cn/" target=_blank>&nbsp;College of Life Science and Technology</a>,<a href="http://www.hust.edu.cn" target=_blank> HUST</a>, China</p>
	<p class="container text-center">Any comments and suggestions, please <a href="http://115.156.239.4/lncRInter/Contact" target=_blank>contact us</a></p>
     </div>
     </div>
     </body>
     </html>

