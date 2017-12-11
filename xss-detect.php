<?php
if(!empty($_POST['str'])){
  $str = $_POST['str'];
  $ptn0 = '/"\ /s'; //type based xss
  $ptn1 = '/">/s'; //tag based xss
  $ptn2 = '/"\ on([^=]*)/s';
  $ptn3 = '/<([^>]*)>/s';

  //ptn0 = type based xss match
  $type = preg_match($ptn0, $str);
  //ptn1 = tag  based xss match
  $tag  = preg_match($ptn1, $str);
  if($type !== false){
	preg_match_all($ptn2, $str, $match1);
  }
  if($tag !== false){
	preg_match_all($ptn3, $str, $match2);
  }
    

}else{
  echo "<h3><font color='red'>Plese send me data.</font></h3>";
}
?>
<html>
<head>
  <title>XSS signature test.</title>
</head>
<body>
  <h1>Can you attack in XSS ?</h1>
  <pre><input type="text" name="test" value="<?php if(!empty($_POST['str'])){echo $str;} ?>" disabled></pre>
  <br>
  <form action="#" method="post">
    <input type="text" name="str" value="">
    <input type="submit" value="submit">
  </form>

<?php if(!empty($_POST['str'])){$str1 = htmlspecialchars($str); echo "<h3>input data:<pre><code>$str1</code></pre></h3>"; } ?>
<?php if(!empty($_POST['str'])){if(count($match1[1]) >= 1){echo "<h3>detect type based signature:<pre><code>"; print_r($match1[1]); echo "</code></pre></h3>"; }} ?>
<br>
<?php if(!empty($_POST['str'])){if(count($match2[1]) >= 1){echo "<h3>detect  tag based signature:<pre><code>"; print_r($match2[1]); echo "</code></pre></h3>"; }} ?>
</body>
</html>

