<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language ?>" xml:lang="<?php print $language ?>">

<head>
  <title><?php print $head_title ?></title>
  <?php print $head ?>
  <?php print $styles ?>
  <?php print $scripts ?>
  <script type="text/javascript"><?php /* Needed to avoid Flash of Unstyle Content in IE */ ?> </script>
</head>

<body bgcolor="#E4F2D6" text="#FFFFFF" link="#FFFFFF" vlink="#FFFFFF" alink="#FFFFFF" leftmargin="1" topmargin="1" marginwidth="1" marginheight="1">

<div align="center">
  <table width="770" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td>
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="770" height="200">
        <param name="movie" value="<?php print base_path() . path_to_theme() ?>/header.swf">
        <param name="quality" value="high">
        <param name="LOOP" value="false">
        <embed src="<?php print base_path() . path_to_theme() ?>/header.swf" width="770" height="200" loop="false" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash"></embed>
      </object>
</td>
</tr>
<tr>
<td valign="top">
<table width="770" border="0" cellspacing="0" cellpadding="0">
        <tr valign="top">

          <td width="542" background="<?php print base_path() . path_to_theme() ?>/images/bg2.jpg" class="bodwb">


	<table width="100%"  border="0" cellpadding="0" cellspacing="0">
		<tr>
                <td width="15">&nbsp;</td>
                <td align="left" vAlign="top" class="bodwb">
	<!-- BEGIN: mission -->
    <?php if ($mission) { ?><div id="mission"><?php print $mission ?></div><?php } ?>
    <!-- END: mission -->

      <div id="main">

       <?php print $breadcrumb ?>
<center>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- 468x60, создано 10.05.08 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:468px;height:60px"
     data-ad-client="ca-pub-9768859166525254"
     data-ad-slot="1941814253"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</center>

      <h1 class="title"><img src="<?php print base_path() . path_to_theme() ?>/images/serv.gif" width="30" height="28"><?php print $title ?></h1>

        <div class="tabs"><?php print $tabs ?></div>
        <div id="help"><?php print $help ?></div>
        <?php print $messages ?>
        <?php print $content; ?>
        <?php print $feed_icons; ?>

        <!-- END: header -->

<!-- BEGIN: footer -->
      </div><!-- main -->
</td>
                <td width="15">&nbsp;</td>
              </tr>
            </table>
</td>

          <td width="228" background="<?php print base_path() . path_to_theme() ?>/images/3.gif" class="bodwb">
    <!-- BEGIN: blocks -->
             <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="15">&nbsp;</td>
                <td valign="middle" class="bodw">
                    <img src="<?php print base_path() . path_to_theme() ?>/images/spec_offr.gif" width="29" height="27">&nbsp;</td>
                <td width="15">&nbsp;</td>
              </tr>
              <tr>
                <td width="15">&nbsp;</td>
                <td valign="top" class="bod">
            <?php print $sidebar_right ?></td>
                <td width="15">&nbsp;</td>
              </tr>
            </table>
 <!-- END: blocks -->

          </td>
        </tr>

        <tr valign="top">
          <td height="60" align="center" valign="middle" background="<?php print base_path() . path_to_theme() ?>/images/bg2.jpg" class="bodwb">

<?php if (isset($primary_links)) { ?><?php print theme('links', $primary_links, array('class' =>'links', 'id' => 'navlist')) ?><?php } ?>	<br><br>

           <!-- banner 468 -->

<center>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- 468x60, создано 10.05.08 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:468px;height:60px"
     data-ad-client="ca-pub-9768859166525254"
     data-ad-slot="1941814253"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</center>

          <td align="center" valign="middle" background="<?php print base_path() . path_to_theme() ?>/images/3.gif" class="bodwb">

            <!-- BEGIN: search_box -->
<?php print $search_box ?>
      <!-- END: search_box -->
<BR>
      <?php if (isset($secondary_links)) { ?><?php print theme('links', $secondary_links, array('class' =>'links', 'id' => 'subnavlist')) ?><?php } ?>
</td>
        </tr>
      </table>
     </td>
    </tr>
    <tr>
      <td>
<table width="770" border="0" cellspacing="0" cellpadding="0" align="center" height="52" background="<?php print base_path() . path_to_theme() ?>/images/footer.gif">
        <tr>
          <td height="52" valign="middle">
            <div align="center"> <span class="bod">
              <!-- BEGIN: message -->
			  <?php print $footer_message ?>
<!-- END: message -->
   </span></div></td>
        </tr>
      </table>
</td>
    </tr>
  </table>
  </div>
<?php print $closure ?>
</body>
</html>
