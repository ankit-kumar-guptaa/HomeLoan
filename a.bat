@echo off
SET "ROOT=home-loan-app"

REM Create main folders
mkdir %ROOT%
mkdir %ROOT%\assets\css
mkdir %ROOT%\assets\js
mkdir %ROOT%\assets\images
mkdir %ROOT%\includes
mkdir %ROOT%\components
mkdir %ROOT%\ajax

REM Create main files
echo.>%ROOT%\index.php
echo.>%ROOT%\assets\css\style.css
echo.>%ROOT%\assets\js\script.js
echo.>%ROOT%\assets\images\hero-bg.jpg
echo.>%ROOT%\assets\images\loan-banner.jpg
echo.>%ROOT%\assets\images\testimonial-bg.jpg
echo.>%ROOT%\assets\images\about-bg.jpg

echo.>%ROOT%\includes\header.php
echo.>%ROOT%\includes\footer.php
echo.>%ROOT%\includes\config.php

echo.>%ROOT%\components\hero.php
echo.>%ROOT%\components\services.php
echo.>%ROOT%\components\calculator.php
echo.>%ROOT%\components\about.php
echo.>%ROOT%\components\testimonials.php
echo.>%ROOT%\components\contact.php

echo.>%ROOT%\ajax\loan-calculator.php

echo Project structure created successfully!
pause
