<!DOCTYPE html>
<html>
<head>
    <title>My first site</title>
    <link href="/css/style.css" rel="stylesheet"/>
    <meta content="text/html" charset="utf-8" http-equiv="Content-Type"/>
</head>
<body>

<div class="all">

    <div class="header">
        header
    </div>

    <div class="clear"></div>

    <div class="content">

        <div class="content_left">

            {for ($i = 1; $i < 6; ++$i)}
                <div>
                    <strong>Block {$i}</strong>
                    <hr/>
                    <div>
                        <ol>
                            <li><a href="/">General Page</a></li>
                            <li><a href="/?page=info">Information</a></li>
                        </ol>

                    </div>
                </div>
                <p class="clear"></p>
            {/for}

        </div>

        <div class="content_right">

            {include datetime_for_page}

            <h3>{$title}</h3>

            <hr/>

            {$content}

        </div>

    </div>

    <div class="clear"></div>

    <div class="footer">
        Copyright © {$date_of_life}
    </div>

</div>

</body>
</html>