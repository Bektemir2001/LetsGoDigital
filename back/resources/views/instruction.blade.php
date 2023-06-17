<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Instructions</title>
</head>
<body>
<style>
    strong{
        /*background: #0096db;*/
        color: #0096db;
    }
</style>
    <div style="padding: 20px;">
        <h2>{{$document->title}}</h2>

        {!! $document->instruction !!}
    </div>
<script>
    let paragraphs = document.getElementsByTagName('strong');
    for (let i = 0; i < paragraphs.length; i++) {
        let paragraph = paragraphs[i];
        if(paragraph.textContent.indexOf('ШАГ') !== -1){
            let checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            paragraph.parentNode.insertBefore(checkbox, paragraph);
        }
    }
</script>
</body>
</html>
