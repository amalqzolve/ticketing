@extends('common.layout')



@section('content')

<style>



	.kt-aside, .kt-sticky-toolbar

	{

		display: none !important;

	}

	.kt-aside--fixed .kt-wrapper

	{

		padding-left:0px !important;

	}

	.kt-aside--enabled .kt-header.kt-header--fixed

	{

		    left: 0px !important;

	}

	a.kt-notification__item:hover

	{

		    color: #402373;

	}

    #kt_footer{

            padding-top: 2px;

    padding-bottom: 2px;

    }

    #kt_header{

        height: 40px;

    }

    .mt-3, .my-3 {

    margin-top: 0 !important;

}

.img-fluid {

    max-width: 100%;

    height: auto;

    width: 100%;

}



	body

	 {

    background: rgba(191,210,219,1);

background: -moz-linear-gradient(top, rgba(191,210,219,1) 0%, rgba(108,156,181,1) 66%, rgba(99,145,168,1) 100%);

background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(191,210,219,1)), color-stop(66%, rgba(108,156,181,1)), color-stop(100%, rgba(99,145,168,1)));

background: -webkit-linear-gradient(top, rgba(191,210,219,1) 0%, rgba(108,156,181,1) 66%, rgba(99,145,168,1) 100%);

background: -o-linear-gradient(top, rgba(191,210,219,1) 0%, rgba(108,156,181,1) 66%, rgba(99,145,168,1) 100%);

background: -ms-linear-gradient(top, rgba(191,210,219,1) 0%, rgba(108,156,181,1) 66%, rgba(99,145,168,1) 100%);

background: linear-gradient(to bottom, rgba(191,210,219,1) 0%, rgba(108,156,181,1) 66%, rgba(99,145,168,1) 100%);

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#bfd2db', endColorstr='#6391a8', GradientType=0 );

background-size: cover;

 background-position: center;

  font-family: "Century Gothic", CenturyGothic, AppleGothic, sans-serif; 

  height: auto;

}

.icon1

{

    background: rgba(203,96,179,1);

background: -moz-linear-gradient(-45deg, rgba(203,96,179,1) 0%, rgba(71,13,52,1) 100%);

background: -webkit-gradient(left top, right bottom, color-stop(0%, rgba(203,96,179,1)), color-stop(100%, rgba(71,13,52,1)));

background: -webkit-linear-gradient(-45deg, rgba(203,96,179,1) 0%, rgba(71,13,52,1) 100%);

background: -o-linear-gradient(-45deg, rgba(203,96,179,1) 0%, rgba(71,13,52,1) 100%);

background: -ms-linear-gradient(-45deg, rgba(203,96,179,1) 0%, rgba(71,13,52,1) 100%);

background: linear-gradient(135deg, rgba(203,96,179,1) 0%, rgba(71,13,52,1) 100%);

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#cb60b3', endColorstr='#470d34', GradientType=1 );

}

.icon2

{

    background: rgba(96,126,201,1);

background: -moz-linear-gradient(-45deg, rgba(96,126,201,1) 0%, rgba(6,6,107,1) 100%);

background: -webkit-gradient(left top, right bottom, color-stop(0%, rgba(96,126,201,1)), color-stop(100%, rgba(6,6,107,1)));

background: -webkit-linear-gradient(-45deg, rgba(96,126,201,1) 0%, rgba(6,6,107,1) 100%);

background: -o-linear-gradient(-45deg, rgba(96,126,201,1) 0%, rgba(6,6,107,1) 100%);

background: -ms-linear-gradient(-45deg, rgba(96,126,201,1) 0%, rgba(6,6,107,1) 100%);

background: linear-gradient(135deg, rgba(96,126,201,1) 0%, rgba(6,6,107,1) 100%);

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#607ec9', endColorstr='#06066b', GradientType=1 );

}

.icon3

{

    background: rgba(0,150,136,1);

background: -moz-linear-gradient(-45deg, rgba(0,150,136,1) 0%, rgba(9,82,75,1) 100%);

background: -webkit-gradient(left top, right bottom, color-stop(0%, rgba(0,150,136,1)), color-stop(100%, rgba(9,82,75,1)));

background: -webkit-linear-gradient(-45deg, rgba(0,150,136,1) 0%, rgba(9,82,75,1) 100%);

background: -o-linear-gradient(-45deg, rgba(0,150,136,1) 0%, rgba(9,82,75,1) 100%);

background: -ms-linear-gradient(-45deg, rgba(0,150,136,1) 0%, rgba(9,82,75,1) 100%);

background: linear-gradient(135deg, rgba(0,150,136,1) 0%, rgba(9,82,75,1) 100%);

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#009688', endColorstr='#09524b', GradientType=1 );

}

.icon4

{

    background: rgba(255,193,7,1);

background: -moz-linear-gradient(-45deg, rgba(255,193,7,1) 0%, rgba(133,103,13,1) 100%);

background: -webkit-gradient(left top, right bottom, color-stop(0%, rgba(255,193,7,1)), color-stop(100%, rgba(133,103,13,1)));

background: -webkit-linear-gradient(-45deg, rgba(255,193,7,1) 0%, rgba(133,103,13,1) 100%);

background: -o-linear-gradient(-45deg, rgba(255,193,7,1) 0%, rgba(133,103,13,1) 100%);

background: -ms-linear-gradient(-45deg, rgba(255,193,7,1) 0%, rgba(133,103,13,1) 100%);

background: linear-gradient(135deg, rgba(255,193,7,1) 0%, rgba(133,103,13,1) 100%);

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffc107', endColorstr='#85670d', GradientType=1 );

}

.icon5

{

    

    background: rgba(126,173,194,1);

background: -moz-linear-gradient(-45deg, rgba(126,173,194,1) 0%, rgba(43,78,94,1) 100%);

background: -webkit-gradient(left top, right bottom, color-stop(0%, rgba(126,173,194,1)), color-stop(100%, rgba(43,78,94,1)));

background: -webkit-linear-gradient(-45deg, rgba(126,173,194,1) 0%, rgba(43,78,94,1) 100%);

background: -o-linear-gradient(-45deg, rgba(126,173,194,1) 0%, rgba(43,78,94,1) 100%);

background: -ms-linear-gradient(-45deg, rgba(126,173,194,1) 0%, rgba(43,78,94,1) 100%);

background: linear-gradient(135deg, rgba(126,173,194,1) 0%, rgba(43,78,94,1) 100%);

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#7eadc2', endColorstr='#2b4e5e', GradientType=1 );

}

.icon6

{

    background: rgba(232,133,111,1);

background: -moz-linear-gradient(-45deg, rgba(232,133,111,1) 0%, rgba(145,40,51,1) 100%);

background: -webkit-gradient(left top, right bottom, color-stop(0%, rgba(232,133,111,1)), color-stop(100%, rgba(145,40,51,1)));

background: -webkit-linear-gradient(-45deg, rgba(232,133,111,1) 0%, rgba(145,40,51,1) 100%);

background: -o-linear-gradient(-45deg, rgba(232,133,111,1) 0%, rgba(145,40,51,1) 100%);

background: -ms-linear-gradient(-45deg, rgba(232,133,111,1) 0%, rgba(145,40,51,1) 100%);

background: linear-gradient(135deg, rgba(232,133,111,1) 0%, rgba(145,40,51,1) 100%);

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e8856f', endColorstr='#912833', GradientType=1 );

}

.icon7

{

    background: rgba(95,168,70,1);

background: -moz-linear-gradient(-45deg, rgba(95,168,70,1) 0%, rgba(21,59,6,1) 100%);

background: -webkit-gradient(left top, right bottom, color-stop(0%, rgba(95,168,70,1)), color-stop(100%, rgba(21,59,6,1)));

background: -webkit-linear-gradient(-45deg, rgba(95,168,70,1) 0%, rgba(21,59,6,1) 100%);

background: -o-linear-gradient(-45deg, rgba(95,168,70,1) 0%, rgba(21,59,6,1) 100%);

background: -ms-linear-gradient(-45deg, rgba(95,168,70,1) 0%, rgba(21,59,6,1) 100%);

background: linear-gradient(135deg, rgba(95,168,70,1) 0%, rgba(21,59,6,1) 100%);

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#5fa846', endColorstr='#153b06', GradientType=1 );

}

.icon8

{

    background: rgba(212,204,136,1);

background: -moz-linear-gradient(-45deg, rgba(212,204,136,1) 0%, rgba(107,98,18,1) 100%);

background: -webkit-gradient(left top, right bottom, color-stop(0%, rgba(212,204,136,1)), color-stop(100%, rgba(107,98,18,1)));

background: -webkit-linear-gradient(-45deg, rgba(212,204,136,1) 0%, rgba(107,98,18,1) 100%);

background: -o-linear-gradient(-45deg, rgba(212,204,136,1) 0%, rgba(107,98,18,1) 100%);

background: -ms-linear-gradient(-45deg, rgba(212,204,136,1) 0%, rgba(107,98,18,1) 100%);

background: linear-gradient(135deg, rgba(212,204,136,1) 0%, rgba(107,98,18,1) 100%);

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#d4cc88', endColorstr='#6b6212', GradientType=1 );

}

.icon9

{

    background: rgba(0,255,0,1);

background: -moz-linear-gradient(-45deg, rgba(0,255,0,1) 0%, rgba(21,112,21,1) 100%);

background: -webkit-gradient(left top, right bottom, color-stop(0%, rgba(0,255,0,1)), color-stop(100%, rgba(21,112,21,1)));

background: -webkit-linear-gradient(-45deg, rgba(0,255,0,1) 0%, rgba(21,112,21,1) 100%);

background: -o-linear-gradient(-45deg, rgba(0,255,0,1) 0%, rgba(21,112,21,1) 100%);

background: -ms-linear-gradient(-45deg, rgba(0,255,0,1) 0%, rgba(21,112,21,1) 100%);

background: linear-gradient(135deg, rgba(0,255,0,1) 0%, rgba(21,112,21,1) 100%);

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00ff00', endColorstr='#157015', GradientType=1 );

}

.icon10

{

    background: rgba(232,109,152,1);

background: -moz-linear-gradient(-45deg, rgba(232,109,152,1) 0%, rgba(97,26,51,1) 100%);

background: -webkit-gradient(left top, right bottom, color-stop(0%, rgba(232,109,152,1)), color-stop(100%, rgba(97,26,51,1)));

background: -webkit-linear-gradient(-45deg, rgba(232,109,152,1) 0%, rgba(97,26,51,1) 100%);

background: -o-linear-gradient(-45deg, rgba(232,109,152,1) 0%, rgba(97,26,51,1) 100%);

background: -ms-linear-gradient(-45deg, rgba(232,109,152,1) 0%, rgba(97,26,51,1) 100%);

background: linear-gradient(135deg, rgba(232,109,152,1) 0%, rgba(97,26,51,1) 100%);

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e86d98', endColorstr='#611a33', GradientType=1 );

}

.icon11

{

    background: rgba(97,119,230,1);

background: -moz-linear-gradient(-45deg, rgba(97,119,230,1) 0%, rgba(11,21,71,1) 100%);

background: -webkit-gradient(left top, right bottom, color-stop(0%, rgba(97,119,230,1)), color-stop(100%, rgba(11,21,71,1)));

background: -webkit-linear-gradient(-45deg, rgba(97,119,230,1) 0%, rgba(11,21,71,1) 100%);

background: -o-linear-gradient(-45deg, rgba(97,119,230,1) 0%, rgba(11,21,71,1) 100%);

background: -ms-linear-gradient(-45deg, rgba(97,119,230,1) 0%, rgba(11,21,71,1) 100%);

background: linear-gradient(135deg, rgba(97,119,230,1) 0%, rgba(11,21,71,1) 100%);

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#6177e6', endColorstr='#0b1547', GradientType=1 );

}

.icon12

{

    background: rgba(33,150,243,1);

background: -moz-linear-gradient(-45deg, rgba(33,150,243,1) 0%, rgba(10,42,66,1) 100%);

background: -webkit-gradient(left top, right bottom, color-stop(0%, rgba(33,150,243,1)), color-stop(100%, rgba(10,42,66,1)));

background: -webkit-linear-gradient(-45deg, rgba(33,150,243,1) 0%, rgba(10,42,66,1) 100%);

background: -o-linear-gradient(-45deg, rgba(33,150,243,1) 0%, rgba(10,42,66,1) 100%);

background: -ms-linear-gradient(-45deg, rgba(33,150,243,1) 0%, rgba(10,42,66,1) 100%);

background: linear-gradient(135deg, rgba(33,150,243,1) 0%, rgba(10,42,66,1) 100%);

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#2196f3', endColorstr='#0a2a42', GradientType=1 );

}

.icon13

{

    background: rgba(154,205,50,1);

background: -moz-linear-gradient(-45deg, rgba(154,205,50,1) 0%, rgba(42,59,5,1) 100%);

background: -webkit-gradient(left top, right bottom, color-stop(0%, rgba(154,205,50,1)), color-stop(100%, rgba(42,59,5,1)));

background: -webkit-linear-gradient(-45deg, rgba(154,205,50,1) 0%, rgba(42,59,5,1) 100%);

background: -o-linear-gradient(-45deg, rgba(154,205,50,1) 0%, rgba(42,59,5,1) 100%);

background: -ms-linear-gradient(-45deg, rgba(154,205,50,1) 0%, rgba(42,59,5,1) 100%);

background: linear-gradient(135deg, rgba(154,205,50,1) 0%, rgba(42,59,5,1) 100%);

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#9acd32', endColorstr='#2a3b05', GradientType=1 );

}

.icon14

{

    background: rgba(240,128,128,1);

background: -moz-linear-gradient(-45deg, rgba(240,128,128,1) 0%, rgba(166,63,63,1) 100%);

background: -webkit-gradient(left top, right bottom, color-stop(0%, rgba(240,128,128,1)), color-stop(100%, rgba(166,63,63,1)));

background: -webkit-linear-gradient(-45deg, rgba(240,128,128,1) 0%, rgba(166,63,63,1) 100%);

background: -o-linear-gradient(-45deg, rgba(240,128,128,1) 0%, rgba(166,63,63,1) 100%);

background: -ms-linear-gradient(-45deg, rgba(240,128,128,1) 0%, rgba(166,63,63,1) 100%);

background: linear-gradient(135deg, rgba(240,128,128,1) 0%, rgba(166,63,63,1) 100%);

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f08080', endColorstr='#a63f3f', GradientType=1 );

}

.icon15

{

    background: rgba(103,58,183,1);

background: -moz-linear-gradient(-45deg, rgba(103,58,183,1) 0%, rgba(9,4,20,1) 100%);

background: -webkit-gradient(left top, right bottom, color-stop(0%, rgba(103,58,183,1)), color-stop(100%, rgba(9,4,20,1)));

background: -webkit-linear-gradient(-45deg, rgba(103,58,183,1) 0%, rgba(9,4,20,1) 100%);

background: -o-linear-gradient(-45deg, rgba(103,58,183,1) 0%, rgba(9,4,20,1) 100%);

background: -ms-linear-gradient(-45deg, rgba(103,58,183,1) 0%, rgba(9,4,20,1) 100%);

background: linear-gradient(135deg, rgba(103,58,183,1) 0%, rgba(9,4,20,1) 100%);

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#673ab7', endColorstr='#090414', GradientType=1 );

}

.icon16

{

    background: rgba(121,85,72,1);

background: -moz-linear-gradient(-45deg, rgba(121,85,72,1) 0%, rgba(38,17,10,1) 100%);

background: -webkit-gradient(left top, right bottom, color-stop(0%, rgba(121,85,72,1)), color-stop(100%, rgba(38,17,10,1)));

background: -webkit-linear-gradient(-45deg, rgba(121,85,72,1) 0%, rgba(38,17,10,1) 100%);

background: -o-linear-gradient(-45deg, rgba(121,85,72,1) 0%, rgba(38,17,10,1) 100%);

background: -ms-linear-gradient(-45deg, rgba(121,85,72,1) 0%, rgba(38,17,10,1) 100%);

background: linear-gradient(135deg, rgba(121,85,72,1) 0%, rgba(38,17,10,1) 100%);

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#795548', endColorstr='#26110a', GradientType=1 );

}

.icon17

{

    background: rgba(179,179,179,1);

background: -moz-linear-gradient(-45deg, rgba(179,179,179,1) 0%, rgba(0,0,0,1) 100%);

background: -webkit-gradient(left top, right bottom, color-stop(0%, rgba(179,179,179,1)), color-stop(100%, rgba(0,0,0,1)));

background: -webkit-linear-gradient(-45deg, rgba(179,179,179,1) 0%, rgba(0,0,0,1) 100%);

background: -o-linear-gradient(-45deg, rgba(179,179,179,1) 0%, rgba(0,0,0,1) 100%);

background: -ms-linear-gradient(-45deg, rgba(179,179,179,1) 0%, rgba(0,0,0,1) 100%);

background: linear-gradient(135deg, rgba(179,179,179,1) 0%, rgba(0,0,0,1) 100%);

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b3b3b3', endColorstr='#000000', GradientType=1 );

}

.icon18

{

    background: rgba(79,132,196,1);

background: -moz-linear-gradient(-45deg, rgba(79,132,196,1) 0%, rgba(2,15,31,1) 100%);

background: -webkit-gradient(left top, right bottom, color-stop(0%, rgba(79,132,196,1)), color-stop(100%, rgba(2,15,31,1)));

background: -webkit-linear-gradient(-45deg, rgba(79,132,196,1) 0%, rgba(2,15,31,1) 100%);

background: -o-linear-gradient(-45deg, rgba(79,132,196,1) 0%, rgba(2,15,31,1) 100%);

background: -ms-linear-gradient(-45deg, rgba(79,132,196,1) 0%, rgba(2,15,31,1) 100%);

background: linear-gradient(135deg, rgba(79,132,196,1) 0%, rgba(2,15,31,1) 100%);

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#4f84c4', endColorstr='#020f1f', GradientType=1 );

}

.icon19

{

   background: rgba(255,0,255,1);

background: -moz-linear-gradient(-45deg, rgba(255,0,255,1) 0%, rgba(122,35,122,1) 100%);

background: -webkit-gradient(left top, right bottom, color-stop(0%, rgba(255,0,255,1)), color-stop(100%, rgba(122,35,122,1)));

background: -webkit-linear-gradient(-45deg, rgba(255,0,255,1) 0%, rgba(122,35,122,1) 100%);

background: -o-linear-gradient(-45deg, rgba(255,0,255,1) 0%, rgba(122,35,122,1) 100%);

background: -ms-linear-gradient(-45deg, rgba(255,0,255,1) 0%, rgba(122,35,122,1) 100%);

background: linear-gradient(135deg, rgba(255,0,255,1) 0%, rgba(122,35,122,1) 100%);

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ff00ff', endColorstr='#7a237a', GradientType=1 );

}

.icon20

{

    background: rgba(0,150,136,1);

background: -moz-linear-gradient(-45deg, rgba(0,150,136,1) 0%, rgba(3,15,14,1) 100%);

background: -webkit-gradient(left top, right bottom, color-stop(0%, rgba(0,150,136,1)), color-stop(100%, rgba(3,15,14,1)));

background: -webkit-linear-gradient(-45deg, rgba(0,150,136,1) 0%, rgba(3,15,14,1) 100%);

background: -o-linear-gradient(-45deg, rgba(0,150,136,1) 0%, rgba(3,15,14,1) 100%);

background: -ms-linear-gradient(-45deg, rgba(0,150,136,1) 0%, rgba(3,15,14,1) 100%);

background: linear-gradient(135deg, rgba(0,150,136,1) 0%, rgba(3,15,14,1) 100%);

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#009688', endColorstr='#030f0e', GradientType=1 );



}

.icon21

{

    background: rgba(255,193,7,1);

background: -moz-linear-gradient(-45deg, rgba(255,193,7,1) 0%, rgba(122,98,24,1) 100%);

background: -webkit-gradient(left top, right bottom, color-stop(0%, rgba(255,193,7,1)), color-stop(100%, rgba(122,98,24,1)));

background: -webkit-linear-gradient(-45deg, rgba(255,193,7,1) 0%, rgba(122,98,24,1) 100%);

background: -o-linear-gradient(-45deg, rgba(255,193,7,1) 0%, rgba(122,98,24,1) 100%);

background: -ms-linear-gradient(-45deg, rgba(255,193,7,1) 0%, rgba(122,98,24,1) 100%);

background: linear-gradient(135deg, rgba(255,193,7,1) 0%, rgba(122,98,24,1) 100%);

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffc107', endColorstr='#7a6218', GradientType=1 );

}

.icon22

{

    background: rgba(166,0,26,1);

background: -moz-linear-gradient(-45deg, rgba(166,0,26,1) 0%, rgba(74,12,23,1) 100%);

background: -webkit-gradient(left top, right bottom, color-stop(0%, rgba(166,0,26,1)), color-stop(100%, rgba(74,12,23,1)));

background: -webkit-linear-gradient(-45deg, rgba(166,0,26,1) 0%, rgba(74,12,23,1) 100%);

background: -o-linear-gradient(-45deg, rgba(166,0,26,1) 0%, rgba(74,12,23,1) 100%);

background: -ms-linear-gradient(-45deg, rgba(166,0,26,1) 0%, rgba(74,12,23,1) 100%);

background: linear-gradient(135deg, rgba(166,0,26,1) 0%, rgba(74,12,23,1) 100%);

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a6001a', endColorstr='#4a0c17', GradientType=1 );

}

.icon23

{

    background: rgba(229,20,0,1);

background: -moz-linear-gradient(-45deg, rgba(229,20,0,1) 0%, rgba(107,39,33,1) 100%);

background: -webkit-gradient(left top, right bottom, color-stop(0%, rgba(229,20,0,1)), color-stop(100%, rgba(107,39,33,1)));

background: -webkit-linear-gradient(-45deg, rgba(229,20,0,1) 0%, rgba(107,39,33,1) 100%);

background: -o-linear-gradient(-45deg, rgba(229,20,0,1) 0%, rgba(107,39,33,1) 100%);

background: -ms-linear-gradient(-45deg, rgba(229,20,0,1) 0%, rgba(107,39,33,1) 100%);

background: linear-gradient(135deg, rgba(229,20,0,1) 0%, rgba(107,39,33,1) 100%);

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e51400', endColorstr='#6b2721', GradientType=1 );

}

.icon24

{

    background: rgba(0,89,96,1);

background: -moz-linear-gradient(-45deg, rgba(0,89,96,1) 0%, rgba(1,19,20,1) 100%);

background: -webkit-gradient(left top, right bottom, color-stop(0%, rgba(0,89,96,1)), color-stop(100%, rgba(1,19,20,1)));

background: -webkit-linear-gradient(-45deg, rgba(0,89,96,1) 0%, rgba(1,19,20,1) 100%);

background: -o-linear-gradient(-45deg, rgba(0,89,96,1) 0%, rgba(1,19,20,1) 100%);

background: -ms-linear-gradient(-45deg, rgba(0,89,96,1) 0%, rgba(1,19,20,1) 100%);

background: linear-gradient(135deg, rgba(0,89,96,1) 0%, rgba(1,19,20,1) 100%);

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#005960', endColorstr='#011314', GradientType=1 );

}

.boxreduse

{

    -webkit-border-radius: 5px;

-moz-border-radius: 5px;

border-radius: 5px;



/*ico*/

width: 75px; 

height: 75px;

 margin: auto; 

 

 padding-top: 25px;  

 margin-bottom: 55px;

}

.boxreduse:hover

{

    width: 76px; 

height: 76px;

-webkit-box-shadow: -2px 5px 13px -4px rgba(0,0,0,0.75);

-moz-box-shadow: -2px 5px 13px -4px rgba(0,0,0,0.75);

box-shadow: -2px 5px 13px -4px rgba(0,0,0,0.75);

padding-top: 23px; 

}

.iconname

{

    text-align: center;

    margin-top: -47px;

    display: block;

    font-weight: bold;

    color: white;

    margin-bottom: 10px;

    text-shadow: 1px 1px gray;

  

}

.mdiv

{

    height: 133px;

}



.icon_container

{

    height: 132px;

}



@media (min-width: 1200px){

    .container {

        width: 1090px;

    }

}

ul.mymenu

{

    list-style-type: none;

  margin: 0;

  padding: 0;

}

ul.mymenu>li

{

    display: inline;

    float: right;

}

ul.mymenu>li >a

{

   margin-right: 20px;

}

.photo

{

    width: 10px; 

    height: 10px;

    -webkit-border-radius: 5px;

-moz-border-radius: 5px;

border-radius: 5px;



}

@media (min-width: 1025px){}

.kt-header--fixed.kt-subheader--fixed.kt-subheader--enabled .kt-wrapper {

    padding-top: 77px;

}}

</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div>

<!-- <ul> -->

	    <!-- <li class="kt-menu__item "><a href="{{url('/inventory')}}/{{$userID}}" class="kt-menu__link ">Inventory</a></li> -->

	    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">



							<!--begin:: Portlet-->

							<div class="p-5 body">

								<div class="kt-portlet__body">

	   <!-- MET THEME -->



    <div class="w3-panel w3-padding-32">

  

    </div>

    <div class="row">



        {{-- Auth::user()->roles->pluck('name') --}}

       

<!-- 

        <?php 

/*if(Auth::user()->hasRole('admin'))

{

  echo 'ittttttts';

}

*/



        ?> -->

        <!--1-->

        <div class="col-md-2 col-sm-4 mdiv">



            <a href="{{url('/')}}/crm">

                

<!-- <a href="http://qzolve-trading.com/demo/crm"> -->

    <!-- <a href="http://qzolve-trading.com/Bait-Al-Raqy/crm"> -->

            

<!-- <a href="http://qzolve-trading.com/App/crm/c/{{ auth::id() }}"> -->

<!-- <a href="http://qzolve-trading.com/Bait-Al-Raqy/crm/c/{{ auth::id() }}"> -->

           

            <div class="icon_container">

                <div class="boxreduse icon1">

                    <center>

                        <i class="fas fa-user-tag iconshadow fa-2x" style="color: white;" aria-hidden="true"></i>

                    </center>

                </div>

            </div>

            <soan class="iconname">CRM</soan></a>

        </div>

        <div class="col-md-2 col-sm-4 mdiv">



            <a href="{{url('/')}}/sales">

                <!-- <a href="http://qzolve-trading.com/demo/sales"> -->



     <!-- <a href="http://qzolve-trading.com/App/sales/s/{{ auth::id() }}"> -->

     <!-- <a href="http://qzolve-trading.com/Bait-Al-Raqy/sales/s/{{ auth::id() }}"> -->



            <div class="icon_container">

                <div class="boxreduse icon2">

                    <center>

                        <i class="fas fa-balance-scale iconshadow fa-2x" style="color: white;" aria-hidden="true"></i>

                    </center>

                </div>

            </div>

            <sapn class="iconname">Sales</sapn>

        </a>

        </div>

        <!--2-->

        <div class="col-md-2 col-sm-4 mdiv">

        <a href="{{url('/')}}/purchase_dashboard">

                <!-- <a href="http://qzolve-trading.com/demo/tradingsettings"> -->



            <div class="icon_container">

                <div class="boxreduse icon6">

                    <center>

                         <i class="fas fa-tasks iconshadow fa-2x" style="color: white;" aria-hidden="true"></i>

                    </center>

                </div>

            </div>

            <span class="iconname">Purchase</span> </a>

        </div>


   

        <div class="col-md-2 col-sm-4 mdiv">

             <a href="{{url('/')}}/inventory">

                <!-- <a href="http://qzolve-trading.com/demo/inventory"> -->

               <!--  <a href="http://localhost/trading/inventory/i/{{ auth::id() }}/{{$branch}}"> -->

            <div class="icon_container">

                <div class="boxreduse icon12">

                    <center>

                        <i class="fas fa-dolly-flatbed iconshadow fa-2x" style="color: white;" aria-hidden="true"></i>

                    </center>

                </div>

            </div>

            <span class="iconname">Inventory</span>

             </a>

        </div>



        <div class="col-md-2 col-sm-4 mdiv">

        <a href="{{url('/')}}/operations">

                <!-- <a href="http://qzolve-trading.com/demo/tradingsettings"> -->



            <div class="icon_container">

                <div class="boxreduse icon5">

                    <center>

                         <i class="fab fa-redhat iconshadow fa-2x" style="color: white;" aria-hidden="true"></i>

                    </center>

                </div>

            </div>

            <span class="iconname">Operations</span> </a>

        </div>



        <div class="col-md-2 col-sm-4 mdiv">

        <a href="{{url('/')}}/contracts">

                <!-- <a href="http://qzolve-trading.com/demo/tradingsettings"> -->



            <div class="icon_container">

                <div class="boxreduse icon5">

                    <center>

                         <i class="fab fa-redhat iconshadow fa-2x" style="color: white;" aria-hidden="true"></i>

                    </center>

                </div>

            </div>

            <span class="iconname">Contracts</span> </a>

        </div>



        <div class="col-md-2 col-sm-4 mdiv">

        <a href="{{url('/')}}/">

                <!-- <a href="http://qzolve-trading.com/demo/tradingsettings"> -->



            <div class="icon_container">

                <div class="boxreduse icon5">

                    <center>

                         <i class="fab fa-redhat iconshadow fa-2x" style="color: white;" aria-hidden="true"></i>

                    </center>

                </div>

            </div>

            <span class="iconname">Request & Approvals</span> </a>

        </div>

        <div class="col-md-2 col-sm-4 mdiv">

    <a href="{{url('/')}}/sub-accounting">

                <!-- <a href="http://qzolve-trading.com/demo/sub-accounting"> -->

               

            <div class="icon_container">

                <div class="boxreduse icon14">

                    <center>

                        <i class="fa fas fa-money-bill-alt iconshadow fa-2x" style="color: white;" aria-hidden="true"></i>

                    </center>

                </div>

            </div>

            <span class="iconname">Branch Finance</span> </a>

        </div>

        

        <!--3-->

    <!--     <div class="col-md-2 col-sm-4 mdiv">



            <a href="http://localhost/trading/purchase">



<a href="http://localhost/trading/purchase/p/{{ auth::id() }}/{{$branch}}">

           

            <div class="icon_container">

                <div class="boxreduse icon3">

                    <center>

                         <i class="fas fa-shopping-basket iconshadow fa-2x" style="color: white;" aria-hidden="true"></i> 

                    </center>

                </div>

            </div>

              <span class="iconname">Purchase</span>

             </a>

        </div> -->





        

   



        <!--4-->

        







     









    <div class="col-md-2 col-sm-4 mdiv">

         <a href="{{url('/')}}/main-accounting">

                <!-- <a href="http://qzolve-trading.com/demo/main-accounting"> -->

            

            <div class="icon_container">

                <div class="boxreduse icon4">

                    <center>

                        <i class="fas fa-unlink iconshadow fa-2x" style="color: white;" aria-hidden="true"></i>

                    </center>

                </div>

            </div>

            <span class="iconname">Company Finance</span> </a>

        </div>





<div class="col-md-2 col-sm-4 mdiv">

        <a href="{{url('/')}}/documentation">

                <!-- <a href="http://qzolve-trading.com/demo/tradingsettings"> -->



            <div class="icon_container">

                <div class="boxreduse icon5">

                    <center>

                         <i class="fab fa-redhat iconshadow fa-2x" style="color: white;" aria-hidden="true"></i>

                    </center>

                </div>

            </div>

            <span class="iconname">Documentation</span> </a>

        </div>







<div class="col-md-2 col-sm-4 mdiv">

        <a href="{{url('/')}}/tradingsettings">

                <!-- <a href="http://qzolve-trading.com/demo/tradingsettings"> -->



            <div class="icon_container">

                <div class="boxreduse icon6">

                    <center>

                         <i class="fas fa-tasks iconshadow fa-2x" style="color: white;" aria-hidden="true"></i>

                    </center>

                </div>

            </div>

            <span class="iconname">Settings</span> </a>

        </div>



    
  <div class="col-md-2 col-sm-4 mdiv">

         <a href="{{url('/')}}/main">

                <!-- <a href="http://qzolve-trading.com/demo/main-accounting"> -->

            

            <div class="icon_container">

                <div class="boxreduse icon4">

                    <center>

                        <i class="fas fa-unlink iconshadow fa-2x" style="color: white;" aria-hidden="true"></i>

                    </center>

                </div>

            </div>

            <span class="iconname">BOQ</span> </a>

        </div>

<div class="col-md-2 col-sm-4 mdiv">

         <a href="{{url('/')}}/pos">

                <!-- <a href="http://qzolve-trading.com/demo/main-accounting"> -->

            

            <div class="icon_container">

                <div class="boxreduse icon4">

                    <center>

                        <i class="fas fa-unlink iconshadow fa-2x" style="color: white;" aria-hidden="true"></i>

                    </center>

                </div>

            </div>

            <span class="iconname">POS</span> </a>

        </div>



<div class="col-md-2 col-sm-4 mdiv">

        <a href="{{url('/')}}/asset_manage">
           <div class="icon_container">

                <div class="boxreduse icon6">

                    <center>

                         <i class="fas fa-tasks iconshadow fa-2x" style="color: white;" aria-hidden="true"></i>

                    </center>

                </div>

            </div>

            <span class="iconname">Asset Management</span> </a>

        </div>
        <div class="col-md-2 col-sm-4 mdiv">

        <a href="{{url('/')}}/projects">
           <div class="icon_container">

                <div class="boxreduse icon6">

                    <center>

                         <i class="fas fa-tasks iconshadow fa-2x" style="color: white;" aria-hidden="true"></i>

                    </center>

                </div>

            </div>

            <span class="iconname">Projects</span> </a>

        </div>

                <div class="col-md-2 col-sm-4 mdiv">

        <a href="{{url('/')}}/resourcemanagement">
           <div class="icon_container">

                <div class="boxreduse icon6">

                    <center>

                         <i class="fas fa-tasks iconshadow fa-2x" style="color: white;" aria-hidden="true"></i>

                    </center>

                </div>

            </div>

            <span class="iconname">Resource Management</span> </a>

        </div>
  <div class="col-md-2 col-sm-4 mdiv">

        <a href="{{url('/')}}/Reports">
           <div class="icon_container">

                <div class="boxreduse icon6">

                    <center>

                         <i class="fas fa-tasks iconshadow fa-2x" style="color: white;" aria-hidden="true"></i>

                    </center>

                </div>

            </div>

            <span class="iconname">Reports</span> </a>

        </div>

          <div class="col-md-2 col-sm-4 mdiv">

        <a href="{{url('/')}}/warehouse">
           <div class="icon_container">

                <div class="boxreduse icon6">

                    <center>

                         <i class="fas fa-tasks iconshadow fa-2x" style="color: white;" aria-hidden="true"></i>

                    </center>

                </div>

            </div>

            <span class="iconname">Warehouse</span> </a>

        </div>
        
        <!--5-->

       <!--  <div class="col-md-2 col-sm-4 mdiv">

            <div class="icon_container">

                <div class="boxreduse icon5">

                    <center>

                        <i class="fab fa-redhat iconshadow fa-2x" style="color: white;" aria-hidden="true"></i>

                    </center>

                </div>

            </div>

            <span class="iconname">Operations</span>

        </div> -->

        <!--6-->     

        <!-- <div class="col-md-2 col-sm-4 mdiv">

            <div class="icon_container">

                <div class="boxreduse icon6">

                    <center>

                         <i class="fas fa-tasks iconshadow fa-2x" style="color: white;" aria-hidden="true"></i>

                    </center>

                </div>

            </div>

            <span class="iconname">Projects</span>

        </div> -->

        <!--7-->

        <!-- <div class="col-md-2 col-sm-4 mdiv">

            <div class="icon_container">

                <div class="boxreduse icon7">

                    <center>

                         <i class="fas fa-briefcase iconshadow fa-2x" style="color: white;" aria-hidden="true"></i>

                    </center>

                </div>

            </div>

            <span class="iconname">Recruitment</span>

        </div> -->

        <!-- 8 -->

        <!-- <div class="col-md-2 col-sm-4 mdiv">

             <a href="http://localhost/Qzolve-ERP/hr">

            <div class="icon_container">

                <div class="boxreduse icon8">

                    <center>

                        <i class="fas fa-person-booth iconshadow fa-2x" style="color: white;" aria-hidden="true"></i>

                    </center>

                </div>

            </div>

        </a>

            <span class="iconname">HR</span>

        </div> -->

        <!-- 9 -->

        <!-- <div class="col-md-2 col-sm-4 mdiv">

            <div class="icon_container">

                <div class="boxreduse icon9">

                    <center>

                        <i class="fas fa-user-clock iconshadow fa-2x" style="color: white;" aria-hidden="true"></i> 

                    </center>

                </div>

            </div>

            <span class="iconname">Attendance</span>

        </div> -->

        <!-- 10 -->

        <!-- <div class="col-md-2 col-sm-4 mdiv">

            <div class="icon_container">

                <div class="boxreduse icon10">

                    <center>

                         <i class="fas fa-comment-dollar iconshadow fa-2x" style="color: white;" aria-hidden="true"></i>

                    </center>

                </div>

            </div>

            <span class="iconname">Payroll</span>

        </div> -->

        <!-- 11 -->

       <!--  <div class="col-md-2 col-sm-4 mdiv">

            <div class="icon_container">

                <div class="boxreduse icon11">

                    <center>

                        <i class="fas fa-pallet iconshadow fa-2x" style="color: white;" aria-hidden="true"></i>

                    </center>

                </div>

            </div>

            <span class="iconname">Warehouse</span>

        </div> -->

        <!-- 12 -->

  



<!--         <div class="col-md-2 col-sm-4 mdiv">

>>>>>>> 3e0a06b3ba1088ee41c10836c54e71b83f2147be

            <div class="icon_container">

                <div class="boxreduse icon12">

                    <center>

                        <i class="fas fa-dolly-flatbed iconshadow fa-2x" style="color: white;" aria-hidden="true"></i>

                    </center>

                </div>

            </div>

            <span class="iconname">Inventory</span>

        </div> -->

        <!-- 13 -->

       <!--  <div class="col-md-2 col-sm-4 mdiv">

            <div class="icon_container">

                <div class="boxreduse icon13">

                    <center>

                       <i class="fas fa-car iconshadow fa-2x" style="color: white;" aria-hidden="true"></i>

                    </center>

                </div>

            </div>

            <span class="iconname">Fleet</span>

        </div> -->

        <!-- 14 -->

        <!-- <div class="col-md-2 col-sm-4 mdiv">

            <div class="icon_container">

                <div class="boxreduse icon14">

                    <center>

                        <i class="fa fas fa-money-bill-alt iconshadow fa-2x" style="color: white;" aria-hidden="true"></i>

                    </center>

                </div>

            </div>

            <span class="iconname">Finance</span>

        </div> -->

        <!-- 15 -->

        <!-- <div class="col-md-2 col-sm-4 mdiv">

            <div class="icon_container">

                <div class="boxreduse icon15">

                    <center>

                        <i class="fa fa-history iconshadow fa-2x" style="color: white;" aria-hidden="true"></i>

                    </center>

                </div>

            </div>

            <span class="iconname">Approvals</span>

        </div> -->

        <!-- 16 -->

        <!-- <div class="col-md-2 col-sm-4 mdiv">

            <div class="icon_container">

                <div class="boxreduse icon16">

                    <center>

                        <i class="fas fa-exchange-alt iconshadow fa-2x" style="color: white;" aria-hidden="true"></i>

                    </center>

                </div>

            </div>

            <span class="iconname">Tickets</span>

        </div> -->

        <!-- 17 -->

        <!-- <div class="col-md-2 col-sm-4 mdiv">

            <div class="icon_container">            

                <div class="boxreduse icon17">

                    <center>

                        <i class="fas fa-poll iconshadow fa-2x" style="color: white;" aria-hidden="true"></i>

                    </center>

                </div>

            </div>

            <span class="iconname">Subscription</span>

        </div> -->

      <!-- 18 -->

        <!-- <div class="col-md-2 col-sm-4 mdiv">

            <div class="icon_container">

                <div class="boxreduse icon18">

                    <center>

                        <i class="fas fa-globe iconshadow fa-2x" style="color: white;" aria-hidden="true"></i>

                    </center>

                </div>

            </div>

            <span class="iconname">Website</span>

        </div> -->

        <!-- 19 -->

        <!-- <div class="col-md-2 col-sm-4 mdiv">

            <div class="icon_container">

                <div class="boxreduse icon19">

                    <center>

                        <i class="fas fa-calendar-minus iconshadow fa-2x" style="color: white;" aria-hidden="true"></i>

                    </center>

                </div>

            </div>

            <span class="iconname">Calender</span>

        </div> -->

        <!-- 20 -->

        <!-- <div class="col-md-2 col-sm-4 mdiv">

            <div class="icon_container">

                <div class="boxreduse icon20">

                    <center>

                        <i class="fas fa-comments iconshadow fa-2x" style="color: white;" aria-hidden="true"></i>

                    </center>

                </div>

            </div>

            <span class="iconname">Chat</span>

        </div> -->

        <!-- 21 -->

        <!-- <div class="col-md-2 col-sm-4 mdiv">

            <div class="icon_container">

                <div class="boxreduse icon21">

                    <center>

                        <i class="fas fa-clipboard iconshadow fa-2x" style="color: white;" aria-hidden="true"></i> 

                    </center>

                </div>

            </div>

            <span class="iconname">Notes</span>

        </div> -->

        <!-- 22 -->

        <!-- <div class="col-md-2 col-sm-4 mdiv">

            <div class="icon_container">

                <div class="boxreduse icon22">

                    <center>

                        <i class="fa fa-file iconshadow fa-2x" style="color: white;" aria-hidden="true"></i>

                    </center>

                </div>

            </div>

            <span class="iconname">Documents</span>

        </div> -->

        <!-- 23 -->

        <!-- <div class="col-md-2 col-sm-4 mdiv">

            <div class="icon_container">

                <div class="boxreduse icon23">

                    <center>

                        <i class="fas fa-tools iconshadow fa-2x" style="color: white;" aria-hidden="true"></i> 

                    </center>

                </div>

            </div>

            <span class="iconname">Settings</span>

        </div> -->

        <!-- 24 -->

        <!-- <div class="col-md-2 col-sm-4 mdiv">

            <div class="icon_container">

                <div class="boxreduse icon24">

                    <center>

                        <i class="fas fa-rocket iconshadow fa-2x" style="color: white;" aria-hidden="true"></i>

                    </center>

                </div>

            </div>

            <span class="iconname">Applications</span>

        </div> -->

    </div>

    <div class="row">

        <div class="col-md-10 mx-auto">

             <!--alert (Add Show Class)-->



             <?php //dd(Session::get('company_name')); 



             if (!session()->has('company_name') ||!session()->has('company_cr')||!session()->has('company_vat')||!session()->has('preview')||!session()->has('common_customer_database')){ ?>

                <div class="alert alert-danger alert-dismissible fade show">

                <button type="button" class="close" data-dismiss="alert">&times;</button>

                <strong>Please update company details in settings application. </strong>

              </div>

             <?php }  ?>

            

              <!--alert-->

              <!--alert (Remove Show Class)-->

           

              <!--alert-->

        </div>

    </div>

    <div class="w3-panel w3-padding-32">

  

    </div>



<!-- MET THEME -->

</div>

</div></div>



<!-- </ul> -->



</div>

@endsection

