<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title><?php echo $this->pageTitle; ?> :: <?php echo Yii::app()->name; ?></title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/main.css" />
    </head>
    <body>
        <header id="header">
            <div class="container text-center top-space">
                <div>
                    <h1><a href="/" id="logo">Yii Skeleton</a></h1>
                    <h2># skeleton application for simple yii projects</h2>
                </div>
                <div>
                    <ul class="social top-space">
                        <li><a href="https://github.com/webattic/skeleton" target="_blank"><i class="fa fa-github-square"></i></a></li>
                        <li class="twitter"><a href="http://twitter.com/web_4life" target="_blank"><i class="fa fa-twitter-square"></i></a></li>
                        <li class="facebook"><a href="http://facebook.com/MatyashPaul"target="_blank"><i class="fa fa-facebook-square"></i></a></li>
                        <li class="linkedin"><a href="http://www.linkedin.com/in/matyash"target="_blank"><i class="fa fa-linkedin-square"></i></a></li>
                        <li class="skype"><a href="skype:matyash_paul?add"><i class="fa fa-skype"></i></a></li>
                    </ul>
                </div>
            </div>
        </header>
        <div class="container">
           <?php echo $content; ?>
        </div>
        <footer></footer>
    </body>
</html>
