<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<div>
  <div>
    <p><?php echo $mail_text_greeting; ?></p>
    <p><?php echo $mail_text_question_answered; ?></p>
    <p style="margin-top: 25px; margin-bottom: 0px; color: #1EAAE7;display: block;font-size: 14px;font-weight: bold;"><?php echo $question_text; ?></p>
    <p style="margin: 0;"><?php echo $answer_text; ?></p>
    <p style="margin-top: 25px; margin-bottom: 0;"><?php echo $mail_text_sincerely; ?></p>    
    <p style="margin-top: 5px;"><a href="<?php echo $store_url; ?>" title="<?php echo $store_name; ?>"><?php echo $store_name; ?></a></p>
  </div>
</div>
</body>
</html>
