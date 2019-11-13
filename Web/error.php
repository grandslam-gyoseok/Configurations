<?php
function get_message($message)
{global $Language,$Messages;
if (array_key_exists($message,$Messages[$Language]))
  {return $Messages[$Language][$message];}
elseif (array_key_exists($message,$Messages["en"]))
  {return $Messages["en"][$message];}
else
  {return $message;}
}

$Messages=
["en"=>
  ["error-403"=>"403 Forbidden",
  "error-403-description-blockedip"=>"Your IP address might be blocked.",
  "error-403-description-directoryindex"=>"Directory indexing is disabled by default and not available in most directories. As such, accessing to directory that is missing index file may cause an error.",
  "error-403-description-emptyuseragent"=>"We don't accept requests with empty user agent.",
  "error-403-description-restrictedpath"=>"Access to some paths is restricted for security reasons.",
  "error-403-subtitle"=>"You don't have permission to access to this page.",
  "error-404"=>"404 Not Found",
  "error-404-subtitle"=>"Cannot find requested page.",
  "error-description-rationale"=>"Why this error occurred?",
  "error-description-solution"=>"What can I do?",
  "error-gotorootpage"=>"Go to root page",
  "error-invalid"=>"Invalid access",
  "error-invalid-description"=>"This page is for displaying HTTP errors and it is not intended to be accessed directly.",
  "error-invalid-subtitle"=>"You tried to access the error page in an invalid way.",
  "error-page-title"=>"Error"],
"ko"=>
  ["error-403-description-blockedip"=>"IP 주소가 차단되었을 수 있습니다.",
  "error-403-description-directoryindex"=>"Directory indexing은 기본적으로 비활성화되어 있으며 대부분의 디렉토리에서 사용할 수 없습니다. 따라서 index 파일이 없는 디렉토리에 접근할 경우 오류가 발생할 수 있습니다.",
  "error-403-description-emptyuseragent"=>"사용자 에이전트에 빈 문자열을 사용하는 요청을 허용하지 않습니다.",
  "error-403-description-restrictedpath"=>"일부 경로는 보안상의 이유로 접근이 제한되어 있습니다.",
  "error-403-subtitle"=>"이 페이지에 접근할 권한이 없습니다.",
  "error-404-subtitle"=>"요청한 페이지를 찾을 수 없습니다.",
  "error-description-rationale"=>"왜 이 오류가 발생했습니까?",
  "error-description-solution"=>"무엇을 할 수 있습니까?",
  "error-gotorootpage"=>"최상위 페이지로 가기",
  "error-invalid"=>"유효하지 않은 접근",
  "error-invalid-description"=>"이 페이지는 HTTP 오류를 표시하는 곳이며 직접 접근하기 위한 것이 아닙니다.",
  "error-invalid-subtitle"=>"유효하지 않은 방법으로 오류 페이지에 접근을 시도했습니다.",
  "error-page-title"=>"오류"]
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
    <title><?= get_message("error-page-title") ?></title>
  </head>
  <body>

<section class="hero is-danger">
  <div class="hero-body">
    <div class="container">
      <h1 class="title"><?= get_message("error-".$response) ?></h1>
      <h2 class="subtitle"><?= get_message("error-".$response."-subtitle") ?></h2>
    </div>
  </div>
</section>

<section class="section">
  <div class="container content">
<?php
switch ($response)
{case "403":
echo("<h1>".get_message("error-description-rationale")."</h1>");
echo("<ul>");
echo("<li>".get_message("error-403-description-blockedip")."</li>");
echo("<li>".get_message("error-403-description-directoryindex")."</li>");
echo("<li>".get_message("error-403-description-emptyuseragent")."</li>");
echo("<li>".get_message("error-403-description-restrictedpath")."</li>");
echo("</ul>");
break;
case "invalid":
echo(get_message("error-invalid-description"));
echo("<div style='text-align: center;'><a href='/'>".get_message("error-gotorootpage")."</a></div>");
break;}
?>
  </div>
</section>

  </body>
</html>
