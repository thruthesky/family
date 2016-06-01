

</div><!-- .content-left-inner -->
</div><!-- .content-left -->

<div class="sidebar content-right">
    <?php require 'sidebar.php'; ?>
</div><!-- .content-right -->
</div><!-- /.layout-content-inner-->
</section><!-- .layout-content -->

<footer>
    <div class="copyright container">
        <div class="row">
            <div class="col-xs-12 col-sm-4">
                <div class="copyright-logo">
                    <img src="<?php echo get_template_directory_uri()?>/tmp/logo.png">
                </div>
            </div>
            <div class="col-xs-12 col-sm-8">
                <div>상호 위세너 대표자 송재호</div>
                <div>
                    카카오톡 thruthesky2
                    전화 070 - 7893 - 1741
                    이메일 thruthesky@gmail.com
                </div>
                <div>사업자등록번호 106-02-98669 통신판매신고번호 2008-경남김해-0098</div>
                <div>주소 경상남도 김해시 한림면 신천리 284</div>
            </div>
        </div>
    </div>
</footer>

<!-- JS Holder -->
<?php wp_footer(); ?>
</body>
</html>

<?php
$html = ob_get_clean();


// 여기서 어떤 페이지에 CSS/JS combine 을 적용할 지 결정한다.
// K-Forum 을 이용하는 경우, 메인/글 목록/글읽기 만 적용한다.
$route = null;
if ( is_front_page() ) $route = 'front-page';
else if ( is_single() ) $route = "single";
else if ( is_category( ) ) $route = "category";
if ( $route ) {
    $css = getNewHTMLOnCSS( $html );
    $url = saveCache( 'css', $route, $css );
    $html = str_replace("</head>", "<link rel='stylesheet' href='$url'></head>", $html);


    $js = getNewHTMLOnJavascript( $html );
    $url = saveCache( 'js', $route, $js );
    $html = str_replace("<!-- JS Holder -->", "<script src='$url'></script></body>", $html);

}
echo $html;


/**
 * 캐시를 저장하고 URL 을 리턴한다.
 *
 * @attention 기존의 캐시 파일을 삭제한다.
 *
 * @param $type - 'js' or 'css'
 * @param $route
 * @param $content
 * @return string
 */
function saveCache( $type, $route, $content ) {
    $md5 = md5( $content );
    $cache_file = cache_abs_dir() . "/$route-$md5.$type";
    if ( ! file_exists($cache_file) ) {
        foreach( glob( cache_abs_dir() . "/$route-*.$type" ) as $file ) {
            @unlink( $file );
        }
        if ( ! is_dir( cache_abs_dir() ) ) mkdir( cache_abs_dir() );
        file_put_contents( $cache_file, $content );
    }
    return home_url() . "/" . cache_rel_dir() . "/$route-$md5.$type";
}
function cache_rel_dir() {
    return 'wp-content/uploads/cache-x';
}
function cache_abs_dir() {
    return ABSPATH . cache_rel_dir();
}



/**
 * HTML 에서 CSS 태그의 Style 코드를 모두 읽어서 리턴한다.
 * @note HTML 에서 기존의 CSS 태그는 없앤다.
 * @param $html
 * @return null|string
 */
function getNewHTMLOnCSS( &$html ) {
    $css = null;
    preg_match_all("/<link.*href=.*(\/wp\-)(.*\.css)[^>]+>/", $html, $ms);
    if ( $ms[2] ) {
        $styles = $ms[2];
        for( $i = 0; $i < count($styles); $i ++ ) {
            $path = 'wp-' . $styles[$i];
            $tag = $ms[0][$i];
            $css .= file_get_contents($path) . "\n";
            $html = str_replace( $tag, '', $html );
        }
    }
    return $css;
}
function getNewHTMLOnJavascript( &$html ) {
    $js = null;
	/** There are many external javascript originated from outside like jetpack, facebook api, google api etc.. */
$host = $_SERVER['HTTP_HOST'];
    preg_match_all("/<script.*src=.*$host.*\/(wp\-includes|wp\-content)(.*.js).+>/", $html, $ms);
    // preg_match_all("/<script.*src=.*\/(wp\-includes|wp\-content)(.*.js).+>/", $html, $ms);
    // preg_match_all("/<script.*src=.*\/(wp\-content)(.*.js).+>/", $html, $ms);
    if ( $ms[1] ) {
        $tags = $ms[0];
        $js = null;
        for( $i = 0; $i < count( $tags ); $i ++ ) {
            $tag = $tags[$i];
            $path = $ms[1][$i] . $ms[2][$i];
            $js .= file_get_contents($path) . "\n";
            $html = str_replace( $tag, '', $html );
        }
    }
    return $js;
}
