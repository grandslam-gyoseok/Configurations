<?php
function get_message($message,$language)
{global $Messages;
if (array_key_exists($message,$Messages[$language]))
  {return $Messages[$language][$message];}
elseif (array_key_exists($message,$Messages["en"]))
  {return $Messages["en"][$message];}
else
  {return $message;}
}

$Messages=
["en"=>
  ["error_403"=>"403 Forbidden",
  "error_403_subtitle"=>"You don't have permission to access to this page.",
  "error_404"=>"404 Not Found",
  "error_404_subtitle"=>"Cannot find requested page.",
  "error_gotorootpage"=>"Go to root page",
  "error_invalid"=>"Invalid access",
  "error_invalid_description"=>"This page is for displaying HTTP errors and it is not intended to be accessed directly.",
  "error_invalid_subtitle"=>"You tried to access the error page in an invalid way.",
  "error_page_title"=>"Error"],
"ko"=>
  ["error_403_subtitle"=>"이 페이지에 접근할 권한이 없습니다.",
  "error_404_subtitle"=>"요청한 페이지를 찾을 수 없습니다.",
  "error_gotorootpage"=>"최상위 페이지로 가기",
  "error_invalid"=>"유효하지 않은 접근",
  "error_invalid_description"=>"이 페이지는 HTTP 오류를 표시하는 곳이며 직접 접근하기 위한 것이 아닙니다.",
  "error_invalid_subtitle"=>"유효하지 않은 방법으로 오류 페이지에 접근을 시도했습니다.",
  "error_page_title"=>"오류"]
];

$Language="en";

if (isset($_GET["response"]))
{$response=$_GET["response"];}
else
{$response="invalid";}
?>
<!DOCTYPE html>
<html>
  <head>
    <link href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta content="width=device-width" name="viewport">
    <title><?= get_message("error_page_title",$Language) ?></title>
  </head>
  <body>

<section class="hero is-danger">
  <div class="hero-body">
    <div class="container">
      <h1 class="title"><?= get_message("error_".$response,$Language) ?></h1>
      <h2 class="subtitle"><?= get_message("error_".$response."_subtitle",$Language) ?></h2>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
<?php
switch ($response)
{case "403":

break;
case "invalid":
echo(get_message("error_invalid_description",$Language));
echo("<div style='text-align: center;'><a href='/'>".get_message("error_gotorootpage",$Language)."</a></div>");
break;}
?>
  </div>
</section>

  </body>
</html>
