<?php
/* SVN FILE: $Id$ */
/**
 * Short description for file.
 *
 * Long description for file
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) Tests <https://trac.cakephp.org/wiki/Developement/TestSuite>
 * Copyright 2005-2008, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 *  Licensed under The Open Group Test Suite License
 *  Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2008, Cake Software Foundation, Inc.
 * @link				https://trac.cakephp.org/wiki/Developement/TestSuite CakePHP(tm) Tests
 * @package			cake.tests
 * @subpackage		cake.tests.cases.libs
 * @since			CakePHP(tm) v 1.2.0.6833
 * @version			$Revision$
 * @modifiedby		$LastChangedBy$
 * @lastmodified	$Date$
 * @license			http://www.opensource.org/licenses/opengroup.php The Open Group Test Suite License
 */
App::import('Core', 'Multibyte');
/**
 * Short description for class.
 *
 * @package    cake.tests
 * @subpackage cake.tests.cases.libs
 */
class MultibyteTest extends UnitTestCase {

	function testUtf8() {
		$string = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$result = Multibyte::utf8($string);
		$expected = array(33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57,
								58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82,
								83, 84, 85, 86, 87, 88, 89, 90, 91, 92, 93, 94, 95, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105,
								106, 107, 108, 109, 110, 111, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123, 124, 125, 126);
		$this->assertEqual($result, $expected);

		$string = '¡¢£¤¥¦§¨©ª«¬­®¯°±²³´µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$result = Multibyte::utf8($string);
		$expected = array(161, 162, 163, 164, 165, 166, 167, 168, 169, 170, 171, 172, 173, 174, 175, 176, 177, 178, 179, 180, 181,
								182, 183, 184, 185, 186, 187, 188, 189, 190, 191, 192, 193, 194, 195, 196, 197, 198, 199, 200);
		$this->assertEqual($result, $expected);

		$string = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬ';
		$result = Multibyte::utf8($string);
		$expected = array(201, 202, 203, 204, 205, 206, 207, 208, 209, 210, 211, 212, 213, 214, 215, 216, 217, 218, 219, 220, 221,
								222, 223, 224, 225, 226, 227, 228, 229, 230, 231, 232, 233, 234, 235, 236, 237, 238, 239, 240, 241, 242,
								243, 244, 245, 246, 247, 248, 249, 250, 251, 252, 253, 254, 255, 256, 257, 258, 259, 260, 261, 262, 263,
								264, 265, 266, 267, 268, 269, 270, 271, 272, 273, 274, 275, 276, 277, 278, 279, 280, 281, 282, 283, 284,
								285, 286, 287, 288, 289, 290, 291, 292, 293, 294, 295, 296, 297, 298, 299, 300);
		$this->assertEqual($result, $expected);

		$string = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃńŅņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$result = Multibyte::utf8($string);
		$expected = array(301, 302, 303, 304, 305, 306, 307, 308, 309, 310, 311, 312, 313, 314, 315, 316, 317, 318, 319, 320, 321,
								322, 323, 324, 325, 326, 327, 328, 329, 330, 331, 332, 333, 334, 335, 336, 337, 338, 339, 340, 341, 342,
								343, 344, 345, 346, 347, 348, 349, 350, 351, 352, 353, 354, 355, 356, 357, 358, 359, 360, 361, 362, 363,
								364, 365, 366, 367, 368, 369, 370, 371, 372, 373, 374, 375, 376, 377, 378, 379, 380, 381, 382, 383, 384,
								385, 386, 387, 388, 389, 390, 391, 392, 393, 394, 395, 396, 397, 398, 399, 400);
		$this->assertEqual($result, $expected);

		$string = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$result = Multibyte::utf8($string);
		$expected = array(401, 402, 403, 404, 405, 406, 407, 408, 409, 410, 411, 412, 413, 414, 415, 416, 417, 418, 419, 420, 421,
								422, 423, 424, 425, 426, 427, 428, 429, 430, 431, 432, 433, 434, 435, 436, 437, 438, 439, 440, 441, 442,
								443, 444, 445, 446, 447, 448, 449, 450, 451, 452, 453, 454, 455, 456, 457, 458, 459, 460, 461, 462, 463,
								464, 465, 466, 467, 468, 469, 470, 471, 472, 473, 474, 475, 476, 477, 478, 479, 480, 481, 482, 483, 484,
								485, 486, 487, 488, 489, 490, 491, 492, 493, 494, 495, 496, 497, 498, 499, 500);
		$this->assertEqual($result, $expected);

		$string = 'əɚɛɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$result = Multibyte::utf8($string);
		$expected = array(601, 602, 603, 604, 605, 606, 607, 608, 609, 610, 611, 612, 613, 614, 615, 616, 617, 618, 619, 620, 621,
								622, 623, 624, 625, 626, 627, 628, 629, 630, 631, 632, 633, 634, 635, 636, 637, 638, 639, 640, 641, 642,
								643, 644, 645, 646, 647, 648, 649, 650, 651, 652, 653, 654, 655, 656, 657, 658, 659, 660, 661, 662, 663,
								664, 665, 666, 667, 668, 669, 670, 671, 672, 673, 674, 675, 676, 677, 678, 679, 680, 681, 682, 683, 684,
								685, 686, 687, 688, 689, 690, 691, 692, 693, 694, 695, 696, 697, 698, 699, 700);
		$this->assertEqual($result, $expected);

		$string = 'ЀЁЂЃЄЅІЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$result = Multibyte::utf8($string);
		$expected = array(1024, 1025, 1026, 1027, 1028, 1029, 1030, 1031, 1032, 1033, 1034, 1035, 1036, 1037, 1038, 1039, 1040, 1041,
								1042, 1043, 1044, 1045, 1046, 1047, 1048, 1049, 1050, 1051);
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$result = Multibyte::utf8($string);
		$expected = array(1052, 1053, 1054, 1055, 1056, 1057, 1058, 1059, 1060, 1061, 1062, 1063, 1064, 1065, 1066, 1067, 1068, 1069,
								1070, 1071, 1072, 1073, 1074, 1075, 1076, 1077, 1078, 1079, 1080, 1081, 1082, 1083, 1084, 1085, 1086, 1087,
								1088, 1089, 1090, 1091, 1092, 1093, 1094, 1095, 1096, 1097, 1098, 1099, 1100);
		$this->assertEqual($result, $expected);

		$string = 'չպջռսվտ';
		$result = Multibyte::utf8($string);
		$expected = array(1401, 1402, 1403, 1404, 1405, 1406, 1407);
		$this->assertEqual($result, $expected);

		$string = 'فقكلمنهوىيًٌٍَُ';
		$result = Multibyte::utf8($string);
		$expected = array(1601, 1602, 1603, 1604, 1605, 1606, 1607, 1608, 1609, 1610, 1611, 1612, 1613, 1614, 1615);
		$this->assertEqual($result, $expected);

		$string = '✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾✿❀❁❂❃❄❅❆❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$result = Multibyte::utf8($string);
		$expected = array(10032, 10033, 10034, 10035, 10036, 10037, 10038, 10039, 10040, 10041, 10042, 10043, 10044,
								10045, 10046, 10047, 10048, 10049, 10050, 10051, 10052, 10053, 10054, 10055, 10056, 10057,
								10058, 10059, 10060, 10061, 10062, 10063, 10064, 10065, 10066, 10067, 10068, 10069, 10070,
								10071, 10072, 10073, 10074, 10075, 10076, 10077, 10078);
		$this->assertEqual($result, $expected);

		$string = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺊⺋⺌⺍⺎⺏⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$result = Multibyte::utf8($string);
		$expected = array(11904, 11905, 11906, 11907, 11908, 11909, 11910, 11911, 11912, 11913, 11914, 11915, 11916, 11917, 11918, 11919,
								11920, 11921, 11922, 11923, 11924, 11925, 11926, 11927, 11928, 11929, 11931, 11932, 11933, 11934, 11935, 11936,
								11937, 11938, 11939, 11940, 11941, 11942, 11943, 11944, 11945, 11946, 11947, 11948, 11949, 11950, 11951, 11952,
								11953, 11954, 11955, 11956, 11957, 11958, 11959, 11960, 11961, 11962, 11963, 11964, 11965, 11966, 11967, 11968,
								11969, 11970, 11971, 11972, 11973, 11974, 11975, 11976, 11977, 11978, 11979, 11980, 11981, 11982, 11983, 11984,
								11985, 11986, 11987, 11988, 11989, 11990, 11991, 11992, 11993, 11994, 11995, 11996, 11997, 11998, 11999, 12000);
		$this->assertEqual($result, $expected);

		$string = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$result = Multibyte::utf8($string);
		$expected = array(12101, 12102, 12103, 12104, 12105, 12106, 12107, 12108, 12109, 12110, 12111, 12112, 12113, 12114, 12115, 12116,
								12117, 12118, 12119, 12120, 12121, 12122, 12123, 12124, 12125, 12126, 12127, 12128, 12129, 12130, 12131, 12132,
								12133, 12134, 12135, 12136, 12137, 12138, 12139, 12140, 12141, 12142, 12143, 12144, 12145, 12146, 12147, 12148,
								12149, 12150, 12151, 12152, 12153, 12154, 12155, 12156, 12157, 12158, 12159);
		$this->assertEqual($result, $expected);

		$string = '눡눢눣눤눥눦눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕뉖뉗뉘뉙뉚뉛뉜뉝뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$result = Multibyte::utf8($string);
		$expected = array(45601, 45602, 45603, 45604, 45605, 45606, 45607, 45608, 45609, 45610, 45611, 45612, 45613, 45614, 45615, 45616,
								45617, 45618, 45619, 45620, 45621, 45622, 45623, 45624, 45625, 45626, 45627, 45628, 45629, 45630, 45631, 45632,
								45633, 45634, 45635, 45636, 45637, 45638, 45639, 45640, 45641, 45642, 45643, 45644, 45645, 45646, 45647, 45648,
								45649, 45650, 45651, 45652, 45653, 45654, 45655, 45656, 45657, 45658, 45659, 45660, 45661, 45662, 45663, 45664,
								45665, 45666, 45667, 45668, 45669, 45670, 45671, 45672, 45673, 45674, 45675, 45676, 45677, 45678, 45679, 45680,
								45681, 45682, 45683, 45684, 45685, 45686, 45687, 45688, 45689, 45690, 45691, 45692, 45693, 45694, 45695, 45696,
								45697, 45698, 45699, 45700);
		$this->assertEqual($result, $expected);

		$string = 'ﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$result = Multibyte::utf8($string);
		$expected = array(65136, 65137, 65138, 65139, 65140, 65141, 65142, 65143, 65144, 65145, 65146, 65147, 65148, 65149, 65150, 65151,
								65152, 65153, 65154, 65155, 65156, 65157, 65158, 65159, 65160, 65161, 65162, 65163, 65164, 65165, 65166, 65167,
								65168, 65169, 65170, 65171, 65172, 65173, 65174, 65175, 65176, 65177, 65178, 65179, 65180, 65181, 65182, 65183,
								65184, 65185, 65186, 65187, 65188, 65189, 65190, 65191, 65192, 65193, 65194, 65195, 65196, 65197, 65198, 65199,
								65200);
		$this->assertEqual($result, $expected);

		$string = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻕﻖﻗﻘﻙﻚﻛﻜﻝﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻸﻹﻺﻻﻼ';
		$result = Multibyte::utf8($string);
		$expected = array(65201, 65202, 65203, 65204, 65205, 65206, 65207, 65208, 65209, 65210, 65211, 65212, 65213, 65214, 65215, 65216,
								65217, 65218, 65219, 65220, 65221, 65222, 65223, 65224, 65225, 65226, 65227, 65228, 65229, 65230, 65231, 65232,
								65233, 65234, 65235, 65236, 65237, 65238, 65239, 65240, 65241, 65242, 65243, 65244, 65245, 65246, 65247, 65248,
								65249, 65250, 65251, 65252, 65253, 65254, 65255, 65256, 65257, 65258, 65259, 65260, 65261, 65262, 65263, 65264,
								65265, 65266, 65267, 65268, 65269, 65270, 65271, 65272, 65273, 65274, 65275, 65276);
		$this->assertEqual($result, $expected);


		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$result = Multibyte::utf8($string);
		$expected = array(65345, 65346, 65347, 65348, 65349, 65350, 65351, 65352, 65353, 65354, 65355, 65356, 65357, 65358, 65359, 65360,
								65361, 65362, 65363, 65364, 65365, 65366, 65367, 65368, 65369, 65370);
		$this->assertEqual($result, $expected);


		$string = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰｱｲｳｴｵｶｷｸ';
		$result = Multibyte::utf8($string);
		$expected = array(65377, 65378, 65379, 65380, 65381, 65382, 65383, 65384, 65385, 65386, 65387, 65388, 65389, 65390, 65391, 65392,
								65393, 65394, 65395, 65396, 65397, 65398, 65399, 65400);
		$this->assertEqual($result, $expected);

		$string = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$result = Multibyte::utf8($string);
		$expected = array(65401, 65402, 65403, 65404, 65405, 65406, 65407, 65408, 65409, 65410, 65411, 65412, 65413, 65414, 65415, 65416,
								65417, 65418, 65419, 65420, 65421, 65422, 65423, 65424, 65425, 65426, 65427, 65428, 65429, 65430, 65431, 65432,
								65433, 65434, 65435, 65436, 65437, 65438);
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$result = Multibyte::utf8($string);
		$expected = array(292, 275, 314, 316, 335, 44, 32, 372, 337, 345, 316, 271, 33);
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$result = Multibyte::utf8($string);
		$expected = array(72, 101, 108, 108, 111, 44, 32, 87, 111, 114, 108, 100, 33);
		$this->assertEqual($result, $expected);

		$string = '¨';
		$result = Multibyte::utf8($string);
		$expected = array(168);
		$this->assertEqual($result, $expected);

		$string = '¿';
		$result = Multibyte::utf8($string);
		$expected = array(191);
		$this->assertEqual($result, $expected);

		$string = 'čini';
		$result = Multibyte::utf8($string);
		$expected = array(269, 105, 110, 105);
		$this->assertEqual($result, $expected);

		$string = 'moći';
		$result = Multibyte::utf8($string);
		$expected = array(109, 111, 263, 105);
		$this->assertEqual($result, $expected);

		$string = 'državni';
		$result = Multibyte::utf8($string);
		$expected = array(100, 114, 382, 97, 118, 110, 105);
		$this->assertEqual($result, $expected);

		$string = '把百度设为首页';
		$result = Multibyte::utf8($string);
		$expected = array(25226, 30334, 24230, 35774, 20026, 39318, 39029);
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$result = Multibyte::utf8($string);
		$expected = array(19968, 20108, 19977, 21608, 27704, 40845);
		$this->assertEqual($result, $expected);
	}

	function testAscii() {
		$utf8 = array(33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57,
							58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82,
							83, 84, 85, 86, 87, 88, 89, 90, 91, 92, 93, 94, 95, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105,
							106, 107, 108, 109, 110, 111, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123, 124, 125, 126);
		$result = Multibyte::ascii($utf8);

		$expected = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$this->assertEqual($result, $expected);

		$utf8 = array(161, 162, 163, 164, 165, 166, 167, 168, 169, 170, 171, 172, 173, 174, 175, 176, 177, 178, 179, 180, 181,
								182, 183, 184, 185, 186, 187, 188, 189, 190, 191, 192, 193, 194, 195, 196, 197, 198, 199, 200);
		$result = Multibyte::ascii($utf8);

		$expected = '¡¢£¤¥¦§¨©ª«¬­®¯°±²³´µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$this->assertEqual($result, $expected);

		$utf8 = array(201, 202, 203, 204, 205, 206, 207, 208, 209, 210, 211, 212, 213, 214, 215, 216, 217, 218, 219, 220, 221,
								222, 223, 224, 225, 226, 227, 228, 229, 230, 231, 232, 233, 234, 235, 236, 237, 238, 239, 240, 241, 242,
								243, 244, 245, 246, 247, 248, 249, 250, 251, 252, 253, 254, 255, 256, 257, 258, 259, 260, 261, 262, 263,
								264, 265, 266, 267, 268, 269, 270, 271, 272, 273, 274, 275, 276, 277, 278, 279, 280, 281, 282, 283, 284,
								285, 286, 287, 288, 289, 290, 291, 292, 293, 294, 295, 296, 297, 298, 299, 300);
		$result = Multibyte::ascii($utf8);
		$expected = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬ';
		$this->assertEqual($result, $expected);

		$utf8 = array(301, 302, 303, 304, 305, 306, 307, 308, 309, 310, 311, 312, 313, 314, 315, 316, 317, 318, 319, 320, 321,
								322, 323, 324, 325, 326, 327, 328, 329, 330, 331, 332, 333, 334, 335, 336, 337, 338, 339, 340, 341, 342,
								343, 344, 345, 346, 347, 348, 349, 350, 351, 352, 353, 354, 355, 356, 357, 358, 359, 360, 361, 362, 363,
								364, 365, 366, 367, 368, 369, 370, 371, 372, 373, 374, 375, 376, 377, 378, 379, 380, 381, 382, 383, 384,
								385, 386, 387, 388, 389, 390, 391, 392, 393, 394, 395, 396, 397, 398, 399, 400);
		$expected = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃńŅņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$result = Multibyte::ascii($utf8);
		$this->assertEqual($result, $expected);

		$utf8 = array(401, 402, 403, 404, 405, 406, 407, 408, 409, 410, 411, 412, 413, 414, 415, 416, 417, 418, 419, 420, 421,
								422, 423, 424, 425, 426, 427, 428, 429, 430, 431, 432, 433, 434, 435, 436, 437, 438, 439, 440, 441, 442,
								443, 444, 445, 446, 447, 448, 449, 450, 451, 452, 453, 454, 455, 456, 457, 458, 459, 460, 461, 462, 463,
								464, 465, 466, 467, 468, 469, 470, 471, 472, 473, 474, 475, 476, 477, 478, 479, 480, 481, 482, 483, 484,
								485, 486, 487, 488, 489, 490, 491, 492, 493, 494, 495, 496, 497, 498, 499, 500);
		$expected = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$result = Multibyte::ascii($utf8);
		$this->assertEqual($result, $expected);

		$utf8 = array(601, 602, 603, 604, 605, 606, 607, 608, 609, 610, 611, 612, 613, 614, 615, 616, 617, 618, 619, 620, 621,
								622, 623, 624, 625, 626, 627, 628, 629, 630, 631, 632, 633, 634, 635, 636, 637, 638, 639, 640, 641, 642,
								643, 644, 645, 646, 647, 648, 649, 650, 651, 652, 653, 654, 655, 656, 657, 658, 659, 660, 661, 662, 663,
								664, 665, 666, 667, 668, 669, 670, 671, 672, 673, 674, 675, 676, 677, 678, 679, 680, 681, 682, 683, 684,
								685, 686, 687, 688, 689, 690, 691, 692, 693, 694, 695, 696, 697, 698, 699, 700);
		$expected = 'əɚɛɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$result = Multibyte::ascii($utf8);
		$this->assertEqual($result, $expected);

		$utf8 = array(1024, 1025, 1026, 1027, 1028, 1029, 1030, 1031, 1032, 1033, 1034, 1035, 1036, 1037, 1038, 1039, 1040, 1041,
								1042, 1043, 1044, 1045, 1046, 1047, 1048, 1049, 1050, 1051);
		$expected = 'ЀЁЂЃЄЅІЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$result = Multibyte::ascii($utf8);
		$this->assertEqual($result, $expected);

		$utf8 = array(1052, 1053, 1054, 1055, 1056, 1057, 1058, 1059, 1060, 1061, 1062, 1063, 1064, 1065, 1066, 1067, 1068, 1069,
								1070, 1071, 1072, 1073, 1074, 1075, 1076, 1077, 1078, 1079, 1080, 1081, 1082, 1083, 1084, 1085, 1086, 1087,
								1088, 1089, 1090, 1091, 1092, 1093, 1094, 1095, 1096, 1097, 1098, 1099, 1100);
		$expected = 'МНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$result = Multibyte::ascii($utf8);
		$this->assertEqual($result, $expected);

		$utf8 = array(1401, 1402, 1403, 1404, 1405, 1406, 1407);
		$expected = 'չպջռսվտ';
		$result = Multibyte::ascii($utf8);
		$this->assertEqual($result, $expected);

		$utf8 = array(1601, 1602, 1603, 1604, 1605, 1606, 1607, 1608, 1609, 1610, 1611, 1612, 1613, 1614, 1615);
		$expected = 'فقكلمنهوىيًٌٍَُ';
		$result = Multibyte::ascii($utf8);
		$this->assertEqual($result, $expected);

		$utf8 = array(10032, 10033, 10034, 10035, 10036, 10037, 10038, 10039, 10040, 10041, 10042, 10043, 10044,
								10045, 10046, 10047, 10048, 10049, 10050, 10051, 10052, 10053, 10054, 10055, 10056, 10057,
								10058, 10059, 10060, 10061, 10062, 10063, 10064, 10065, 10066, 10067, 10068, 10069, 10070,
								10071, 10072, 10073, 10074, 10075, 10076, 10077, 10078);
		$expected = '✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾✿❀❁❂❃❄❅❆❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$result = Multibyte::ascii($utf8);
		$this->assertEqual($result, $expected);

		$utf8 = array(11904, 11905, 11906, 11907, 11908, 11909, 11910, 11911, 11912, 11913, 11914, 11915, 11916, 11917, 11918, 11919,
								11920, 11921, 11922, 11923, 11924, 11925, 11926, 11927, 11928, 11929, 11931, 11932, 11933, 11934, 11935, 11936,
								11937, 11938, 11939, 11940, 11941, 11942, 11943, 11944, 11945, 11946, 11947, 11948, 11949, 11950, 11951, 11952,
								11953, 11954, 11955, 11956, 11957, 11958, 11959, 11960, 11961, 11962, 11963, 11964, 11965, 11966, 11967, 11968,
								11969, 11970, 11971, 11972, 11973, 11974, 11975, 11976, 11977, 11978, 11979, 11980, 11981, 11982, 11983, 11984,
								11985, 11986, 11987, 11988, 11989, 11990, 11991, 11992, 11993, 11994, 11995, 11996, 11997, 11998, 11999, 12000);
		$expected = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺊⺋⺌⺍⺎⺏⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$result = Multibyte::ascii($utf8);
		$this->assertEqual($result, $expected);

		$utf8 = array(12101, 12102, 12103, 12104, 12105, 12106, 12107, 12108, 12109, 12110, 12111, 12112, 12113, 12114, 12115, 12116,
								12117, 12118, 12119, 12120, 12121, 12122, 12123, 12124, 12125, 12126, 12127, 12128, 12129, 12130, 12131, 12132,
								12133, 12134, 12135, 12136, 12137, 12138, 12139, 12140, 12141, 12142, 12143, 12144, 12145, 12146, 12147, 12148,
								12149, 12150, 12151, 12152, 12153, 12154, 12155, 12156, 12157, 12158, 12159);
		$expected = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$result = Multibyte::ascii($utf8);
		$this->assertEqual($result, $expected);

		$utf8 = array(45601, 45602, 45603, 45604, 45605, 45606, 45607, 45608, 45609, 45610, 45611, 45612, 45613, 45614, 45615, 45616,
								45617, 45618, 45619, 45620, 45621, 45622, 45623, 45624, 45625, 45626, 45627, 45628, 45629, 45630, 45631, 45632,
								45633, 45634, 45635, 45636, 45637, 45638, 45639, 45640, 45641, 45642, 45643, 45644, 45645, 45646, 45647, 45648,
								45649, 45650, 45651, 45652, 45653, 45654, 45655, 45656, 45657, 45658, 45659, 45660, 45661, 45662, 45663, 45664,
								45665, 45666, 45667, 45668, 45669, 45670, 45671, 45672, 45673, 45674, 45675, 45676, 45677, 45678, 45679, 45680,
								45681, 45682, 45683, 45684, 45685, 45686, 45687, 45688, 45689, 45690, 45691, 45692, 45693, 45694, 45695, 45696,
								45697, 45698, 45699, 45700);
		$expected = '눡눢눣눤눥눦눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕뉖뉗뉘뉙뉚뉛뉜뉝뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$result = Multibyte::ascii($utf8);
		$this->assertEqual($result, $expected);

		$utf8 = array(65136, 65137, 65138, 65139, 65140, 65141, 65142, 65143, 65144, 65145, 65146, 65147, 65148, 65149, 65150, 65151,
								65152, 65153, 65154, 65155, 65156, 65157, 65158, 65159, 65160, 65161, 65162, 65163, 65164, 65165, 65166, 65167,
								65168, 65169, 65170, 65171, 65172, 65173, 65174, 65175, 65176, 65177, 65178, 65179, 65180, 65181, 65182, 65183,
								65184, 65185, 65186, 65187, 65188, 65189, 65190, 65191, 65192, 65193, 65194, 65195, 65196, 65197, 65198, 65199,
								65200);
		$expected = 'ﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$result = Multibyte::ascii($utf8);
		$this->assertEqual($result, $expected);

		$utf8 = array(65201, 65202, 65203, 65204, 65205, 65206, 65207, 65208, 65209, 65210, 65211, 65212, 65213, 65214, 65215, 65216,
								65217, 65218, 65219, 65220, 65221, 65222, 65223, 65224, 65225, 65226, 65227, 65228, 65229, 65230, 65231, 65232,
								65233, 65234, 65235, 65236, 65237, 65238, 65239, 65240, 65241, 65242, 65243, 65244, 65245, 65246, 65247, 65248,
								65249, 65250, 65251, 65252, 65253, 65254, 65255, 65256, 65257, 65258, 65259, 65260, 65261, 65262, 65263, 65264,
								65265, 65266, 65267, 65268, 65269, 65270, 65271, 65272, 65273, 65274, 65275, 65276);
		$expected = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻕﻖﻗﻘﻙﻚﻛﻜﻝﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻸﻹﻺﻻﻼ';
		$result = Multibyte::ascii($utf8);
		$this->assertEqual($result, $expected);

		$utf8 = array(65345, 65346, 65347, 65348, 65349, 65350, 65351, 65352, 65353, 65354, 65355, 65356, 65357, 65358, 65359, 65360,
								65361, 65362, 65363, 65364, 65365, 65366, 65367, 65368, 65369, 65370);
		$expected = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$result = Multibyte::ascii($utf8);
		$this->assertEqual($result, $expected);

		$utf8 = array(65377, 65378, 65379, 65380, 65381, 65382, 65383, 65384, 65385, 65386, 65387, 65388, 65389, 65390, 65391, 65392,
								65393, 65394, 65395, 65396, 65397, 65398, 65399, 65400);
		$expected = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰｱｲｳｴｵｶｷｸ';
		$result = Multibyte::ascii($utf8);
		$this->assertEqual($result, $expected);

		$utf8 = array(65401, 65402, 65403, 65404, 65405, 65406, 65407, 65408, 65409, 65410, 65411, 65412, 65413, 65414, 65415, 65416,
								65417, 65418, 65419, 65420, 65421, 65422, 65423, 65424, 65425, 65426, 65427, 65428, 65429, 65430, 65431, 65432,
								65433, 65434, 65435, 65436, 65437, 65438);
		$expected = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$result = Multibyte::ascii($utf8);
		$this->assertEqual($result, $expected);

		$utf8 = array(292, 275, 314, 316, 335, 44, 32, 372, 337, 345, 316, 271, 33);
		$expected = 'Ĥēĺļŏ, Ŵőřļď!';
		$result = Multibyte::ascii($utf8);
		$this->assertEqual($result, $expected);

		$utf8 = array(72, 101, 108, 108, 111, 44, 32, 87, 111, 114, 108, 100, 33);
		$expected = 'Hello, World!';
		$result = Multibyte::ascii($utf8);
		$this->assertEqual($result, $expected);

		$utf8 = array(168);
		$expected = '¨';
		$result = Multibyte::ascii($utf8);
		$this->assertEqual($result, $expected);

		$utf8 = array(191);
		$expected = '¿';
		$result = Multibyte::ascii($utf8);
		$this->assertEqual($result, $expected);

		$utf8 = array(269, 105, 110, 105);
		$expected = 'čini';
		$result = Multibyte::ascii($utf8);
		$this->assertEqual($result, $expected);

		$utf8 = array(109, 111, 263, 105);
		$expected = 'moći';
		$result = Multibyte::ascii($utf8);
		$this->assertEqual($result, $expected);

		$utf8 = array(100, 114, 382, 97, 118, 110, 105);
		$expected = 'državni';
		$result = Multibyte::ascii($utf8);
		$this->assertEqual($result, $expected);

		$utf8 = array(25226, 30334, 24230, 35774, 20026, 39318, 39029);
		$expected = '把百度设为首页';
		$result = Multibyte::ascii($utf8);
		$this->assertEqual($result, $expected);

		$utf8 = array(19968, 20108, 19977, 21608, 27704, 40845);
		$expected = '一二三周永龍';
		$result = Multibyte::ascii($utf8);
		$this->assertEqual($result, $expected);
	}

	function testUsingMbStripos() {
		$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$find = 'f';
		$result = mb_stripos($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'ABCDEFGHIJKLMNOPQFRSTUVWXYZ0123456789';
		$find = 'f';
		$result = mb_stripos($string, $find, 6);
		$expected = 17;
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$find = 'å';
		$result = mb_stripos($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÅÙÚÛÜÝÞ';
		$find = 'å';
		$result = mb_stripos($string, $find, 6);
		$expected = 24;
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$find = 'ċ';
		$result = mb_stripos($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁĊŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$find = 'ċ';
		$result = mb_stripos($string, $find, 6);
		$expected = 32;
		$this->assertEqual($result, $expected);

		$string = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$find = 'f';
		$result = mb_stripos($string, $find);
		$expected = 37;
		$this->assertEqual($result, $expected);

		$string = '¡¢£¤¥¦§¨©ª«¬­®¯°±²³´µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$find = 'Μ';
		$result = mb_stripos($string, $find);
		$expected = 20;
		$this->assertEqual($result, $expected);

		$string = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬ';
		$find = 'É';
		$result = mb_stripos($string, $find, 6);
		$expected = 32;
		$this->assertEqual($result, $expected);

		$string = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃńŅņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$find = 'Ņ';
		$result = mb_stripos($string, $find);
		$expected = 24;
		$this->assertEqual($result, $expected);

		$string = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$find = 'Ƹ';
		$result = mb_stripos($string, $find);
		$expected = 39;
		$this->assertEqual($result, $expected);

		$string = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$find = 'Ƹ';
		$result = mb_stripos($string, $find, 40);
		$expected = 40;
		$this->assertEqual($result, $expected);

		$string = 'əɚɛɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$find = 'Ʀ';
		$result = mb_stripos($string, $find);
		$expected = 39;
		$this->assertEqual($result, $expected);

		$string = 'ЀЁЂЃЄЅІЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$find = 'ї';
		$result = mb_stripos($string, $find);
		$expected = 7;
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$find = 'Р';
		$result = mb_stripos($string, $find);
		$expected = 4;
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$find = 'Р';
		$result = mb_stripos($string, $find, 5);
		$expected = 36;
		$this->assertEqual($result, $expected);

		$string = 'فقكلمنهوىيًٌٍَُ';
		$find = 'ن';
		$result = mb_stripos($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = '✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾✿❀❁❂❃❄❅❆❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$find = '✿';
		$result = mb_stripos($string, $find);
		$expected = 15;
		$this->assertEqual($result, $expected);

		$string = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺊⺋⺌⺍⺎⺏⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$find = '⺐';
		$result = mb_stripos($string, $find);
		$expected = 16;
		$this->assertEqual($result, $expected);

		$string = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$find = '⽤';
		$result = mb_stripos($string, $find);
		$expected = 31;
		$this->assertEqual($result, $expected);

		$string = '눡눢눣눤눥눦눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕뉖뉗뉘뉙뉚뉛뉜뉝뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$find = '눻';
		$result = mb_stripos($string, $find);
		$expected = 26;
		$this->assertEqual($result, $expected);

		$string = 'ﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$find = 'ﺞ';
		$result = mb_stripos($string, $find);
		$expected = 46;
		$this->assertEqual($result, $expected);

		$string = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻕﻖﻗﻘﻙﻚﻛﻜﻝﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻸﻹﻺﻻﻼ';
		$find = 'ﻞ';
		$result = mb_stripos($string, $find);
		$expected = 45;
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'ｋ';
		$result = mb_stripos($string, $find);
		$expected = 10;
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'Ｋ';
		$result = mb_stripos($string, $find);
		$expected = 10;
		$this->assertEqual($result, $expected);

		$string = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰｱｲｳｴｵｶｷｸ';
		$find = 'ｱ';
		$result = mb_stripos($string, $find);
		$expected = 16;
		$this->assertEqual($result, $expected);

		$string = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$find = 'ﾊ';
		$result = mb_stripos($string, $find);
		$expected = 17;
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'ő';
		$result = mb_stripos($string, $find);
		$expected = 8;
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'Ő';
		$result = mb_stripos($string, $find);
		$expected = 8;
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'O';
		$result = mb_stripos($string, $find);
		$expected = 4;
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'o';
		$result = mb_stripos($string, $find);
		$expected = 4;
		$this->assertEqual($result, $expected);

		$string = 'čini';
		$find = 'n';
		$result = mb_stripos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = 'čini';
		$find = 'N';
		$result = mb_stripos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = 'moći';
		$find = 'ć';
		$result = mb_stripos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = 'moći';
		$find = 'Ć';
		$result = mb_stripos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = 'državni';
		$find = 'ž';
		$result = mb_stripos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = 'državni';
		$find = 'Ž';
		$result = mb_stripos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = '把百度设为首页';
		$find = '设';
		$result = mb_stripos($string, $find);
		$expected = 3;
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$find = '周';
		$result = mb_stripos($string, $find);
		$expected = 3;
		$this->assertEqual($result, $expected);

		$string = 'državni';
		$find = 'DŽ';
		$result = mb_stripos($string, $find);
		$expected = false;
		$this->assertEqual($result, $expected);
	}

	function testMultibyteStripos() {
		$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$find = 'f';
		$result = Multibyte::stripos($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'ABCDEFGHIJKLMNOPQFRSTUVWXYZ0123456789';
		$find = 'f';
		$result = Multibyte::stripos($string, $find, 6);
		$expected = 17;
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$find = 'å';
		$result = Multibyte::stripos($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÅÙÚÛÜÝÞ';
		$find = 'å';
		$result = Multibyte::stripos($string, $find, 6);
		$expected = 24;
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$find = 'ċ';
		$result = Multibyte::stripos($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁĊŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$find = 'ċ';
		$result = Multibyte::stripos($string, $find, 6);
		$expected = 32;
		$this->assertEqual($result, $expected);

		$string = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$find = 'f';
		$result = Multibyte::stripos($string, $find);
		$expected = 37;
		$this->assertEqual($result, $expected);

		$string = '¡¢£¤¥¦§¨©ª«¬­®¯°±²³´µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$find = 'Μ';
		$result = Multibyte::stripos($string, $find);
		$expected = 20;
		$this->assertEqual($result, $expected);

		$string = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬ';
		$find = 'É';
		$result = Multibyte::stripos($string, $find, 6);
		$expected = 32;
		$this->assertEqual($result, $expected);

		$string = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃńŅņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$find = 'Ņ';
		$result = Multibyte::stripos($string, $find);
		$expected = 24;
		$this->assertEqual($result, $expected);

		$string = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$find = 'Ƹ';
		$result = Multibyte::stripos($string, $find);
		$expected = 39;
		$this->assertEqual($result, $expected);

		$string = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$find = 'Ƹ';
		$result = Multibyte::stripos($string, $find, 40);
		$expected = 40;
		$this->assertEqual($result, $expected);

		$string = 'əɚɛɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$find = 'Ʀ';
		$result = Multibyte::stripos($string, $find);
		$expected = 39;
		$this->assertEqual($result, $expected);

		$string = 'ЀЁЂЃЄЅІЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$find = 'ї';
		$result = Multibyte::stripos($string, $find);
		$expected = 7;
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$find = 'Р';
		$result = Multibyte::stripos($string, $find);
		$expected = 4;
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$find = 'Р';
		$result = Multibyte::stripos($string, $find, 5);
		$expected = 36;
		$this->assertEqual($result, $expected);

		$string = 'فقكلمنهوىيًٌٍَُ';
		$find = 'ن';
		$result = Multibyte::stripos($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = '✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾✿❀❁❂❃❄❅❆❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$find = '✿';
		$result = Multibyte::stripos($string, $find);
		$expected = 15;
		$this->assertEqual($result, $expected);

		$string = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺊⺋⺌⺍⺎⺏⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$find = '⺐';
		$result = Multibyte::stripos($string, $find);
		$expected = 16;
		$this->assertEqual($result, $expected);

		$string = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$find = '⽤';
		$result = Multibyte::stripos($string, $find);
		$expected = 31;
		$this->assertEqual($result, $expected);

		$string = '눡눢눣눤눥눦눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕뉖뉗뉘뉙뉚뉛뉜뉝뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$find = '눻';
		$result = Multibyte::stripos($string, $find);
		$expected = 26;
		$this->assertEqual($result, $expected);

		$string = 'ﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$find = 'ﺞ';
		$result = Multibyte::stripos($string, $find);
		$expected = 46;
		$this->assertEqual($result, $expected);

		$string = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻕﻖﻗﻘﻙﻚﻛﻜﻝﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻸﻹﻺﻻﻼ';
		$find = 'ﻞ';
		$result = Multibyte::stripos($string, $find);
		$expected = 45;
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'ｋ';
		$result = Multibyte::stripos($string, $find);
		$expected = 10;
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'Ｋ';
		$result = Multibyte::stripos($string, $find);
		$expected = 10;
		$this->assertEqual($result, $expected);

		$string = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰｱｲｳｴｵｶｷｸ';
		$find = 'ｱ';
		$result = Multibyte::stripos($string, $find);
		$expected = 16;
		$this->assertEqual($result, $expected);

		$string = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$find = 'ﾊ';
		$result = Multibyte::stripos($string, $find);
		$expected = 17;
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'ő';
		$result = Multibyte::stripos($string, $find);
		$expected = 8;
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'Ő';
		$result = Multibyte::stripos($string, $find);
		$expected = 8;
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'O';
		$result = Multibyte::stripos($string, $find);
		$expected = 4;
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'o';
		$result = Multibyte::stripos($string, $find);
		$expected = 4;
		$this->assertEqual($result, $expected);

		$string = 'čini';
		$find = 'n';
		$result = Multibyte::stripos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = 'čini';
		$find = 'N';
		$result = Multibyte::stripos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = 'moći';
		$find = 'ć';
		$result = Multibyte::stripos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = 'moći';
		$find = 'Ć';
		$result = Multibyte::stripos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = 'državni';
		$find = 'ž';
		$result = Multibyte::stripos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = 'državni';
		$find = 'Ž';
		$result = Multibyte::stripos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = '把百度设为首页';
		$find = '设';
		$result = Multibyte::stripos($string, $find);
		$expected = 3;
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$find = '周';
		$result = Multibyte::stripos($string, $find);
		$expected = 3;
		$this->assertEqual($result, $expected);

		$string = 'državni';
		$find = 'DŽ';
		$result = Multibyte::stripos($string, $find);
		$expected = false;
		$this->assertEqual($result, $expected);
	}

	function testUsingMbStristr() {
		$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$find = 'f';
		$result = mb_stristr($string, $find);
		$expected = 'FGHIJKLMNOPQRSTUVWXYZ0123456789';
		$this->assertEqual($result, $expected);

		$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$find = 'f';
		$result = mb_stristr($string, $find, true);
		$expected = 'ABCDE';
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$find = 'å';
		$result = mb_stristr($string, $find);
		$expected = 'ÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$find = 'å';
		$result = mb_stristr($string, $find, true);
		$expected = 'ÀÁÂÃÄ';
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$find = 'ċ';
		$result = mb_stristr($string, $find);
		$expected = 'ĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$find = 'ċ';
		$result = mb_stristr($string, $find, true);
		$expected = 'ĀĂĄĆĈ';
		$this->assertEqual($result, $expected);

		$string = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$find = 'f';
		$result = mb_stristr($string, $find);
		$expected = 'FGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$this->assertEqual($result, $expected);

		$string = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$find = 'f';
		$result = mb_stristr($string, $find, true);
		$expected = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDE';
		$this->assertEqual($result, $expected);

		$string = '¡¢£¤¥¦§¨©ª«¬­®¯°±²³´µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$find = 'Μ';
		$result = mb_stristr($string, $find);
		$expected = 'µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$this->assertEqual($result, $expected);

		$string = '¡¢£¤¥¦§¨©ª«¬­®¯°±²³´µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$find = 'Μ';
		$result = mb_stristr($string, $find, true);
		$expected = '¡¢£¤¥¦§¨©ª«¬­®¯°±²³´';
		$this->assertEqual($result, $expected);

		$string = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬ';
		$find = 'þ';
		$result = mb_stristr($string, $find);
		$expected = 'Þßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬ';
		$this->assertEqual($result, $expected);

		$string = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬ';
		$find = 'þ';
		$result = mb_stristr($string, $find, true);
		$expected = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝ';
		$this->assertEqual($result, $expected);

		$string = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃńŅņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$find = 'Ņ';
		$result = mb_stristr($string, $find);
		$expected = 'ŅņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$this->assertEqual($result, $expected);

		$string = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃńŅņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$find = 'Ņ';
		$result = mb_stristr($string, $find, true);
		$expected = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃń';
		$this->assertEqual($result, $expected);

		$string = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$find = 'Ƹ';
		$result = mb_stristr($string, $find);
		$expected = 'ƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$this->assertEqual($result, $expected);

		$find = 'Ƹ';
		$result = mb_stristr($string, $find, true);
		$expected = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷ';
		$this->assertEqual($result, $expected);

		$string = 'əɚɛɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$find = 'Ʀ';
		$result = mb_stristr($string, $find);
		$expected = 'ʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$this->assertEqual($result, $expected);

		$string = 'əɚɛɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$find = 'Ʀ';
		$result = mb_stristr($string, $find, true);
		$expected = 'əɚɛɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿ';
		$this->assertEqual($result, $expected);

		$string = 'ЀЁЂЃЄЅІЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$find = 'ї';
		$result = mb_stristr($string, $find);
		$expected = 'ЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$this->assertEqual($result, $expected);

		$string = 'ЀЁЂЃЄЅІЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$find = 'ї';
		$result = mb_stristr($string, $find, true);
		$expected = 'ЀЁЂЃЄЅІ';
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$find = 'Р';
		$result = mb_stristr($string, $find);
		$expected = 'РСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$find = 'Р';
		$result = mb_stristr($string, $find, true);
		$expected = 'МНОП';
		$this->assertEqual($result, $expected);

		$string = 'فقكلمنهوىيًٌٍَُ';
		$find = 'ن';
		$result = mb_stristr($string, $find);
		$expected = 'نهوىيًٌٍَُ';
		$this->assertEqual($result, $expected);

		$string = 'فقكلمنهوىيًٌٍَُ';
		$find = 'ن';
		$result = mb_stristr($string, $find, true);
		$expected = 'فقكلم';
		$this->assertEqual($result, $expected);

		$string = '✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾✿❀❁❂❃❄❅❆❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$find = '✿';
		$result = mb_stristr($string, $find);
		$expected = '✿❀❁❂❃❄❅❆❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$this->assertEqual($result, $expected);

		$string = '✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾✿❀❁❂❃❄❅❆❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$find = '✿';
		$result = mb_stristr($string, $find, true);
		$expected = '✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾';
		$this->assertEqual($result, $expected);

		$string = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺊⺋⺌⺍⺎⺏⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$find = '⺐';
		$result = mb_stristr($string, $find);
		$expected = '⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$this->assertEqual($result, $expected);

		$string = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺊⺋⺌⺍⺎⺏⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$find = '⺐';
		$result = mb_stristr($string, $find, true);
		$expected = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺊⺋⺌⺍⺎⺏';
		$this->assertEqual($result, $expected);

		$string = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$find = '⽤';
		$result = mb_stristr($string, $find);
		$expected = '⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$this->assertEqual($result, $expected);

		$string = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$find = '⽤';
		$result = mb_stristr($string, $find, true);
		$expected = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣';
		$this->assertEqual($result, $expected);

		$string = '눡눢눣눤눥눦눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕뉖뉗뉘뉙뉚뉛뉜뉝뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$find = '눻';
		$result = mb_stristr($string, $find);
		$expected = '눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕뉖뉗뉘뉙뉚뉛뉜뉝뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$this->assertEqual($result, $expected);

		$string = '눡눢눣눤눥눦눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕뉖뉗뉘뉙뉚뉛뉜뉝뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$find = '눻';
		$result = mb_stristr($string, $find, true);
		$expected = '눡눢눣눤눥눦눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺';
		$this->assertEqual($result, $expected);

		$string = 'ﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$find = 'ﺞ';
		$result = mb_stristr($string, $find);
		$expected = 'ﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$this->assertEqual($result, $expected);

		$string = 'ﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$find = 'ﺞ';
		$result = mb_stristr($string, $find, true);
		$expected = 'ﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝ';
		$this->assertEqual($result, $expected);

		$string = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻕﻖﻗﻘﻙﻚﻛﻜﻝﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻸﻹﻺﻻﻼ';
		$find = 'ﻞ';
		$result = mb_stristr($string, $find);
		$expected = 'ﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻸﻹﻺﻻﻼ';
		$this->assertEqual($result, $expected);

		$string = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻕﻖﻗﻘﻙﻚﻛﻜﻝﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻸﻹﻺﻻﻼ';
		$find = 'ﻞ';
		$result = mb_stristr($string, $find, true);
		$expected = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻕﻖﻗﻘﻙﻚﻛﻜﻝ';
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'Ｋ';
		$result = mb_stristr($string, $find);
		$expected = 'ｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'Ｋ';
		$result = mb_stristr($string, $find, true);
		$expected = 'ａｂｃｄｅｆｇｈｉｊ';
		$this->assertEqual($result, $expected);

		$string = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰｱｲｳｴｵｶｷｸ';
		$find = 'ｱ';
		$result = mb_stristr($string, $find);
		$expected = 'ｱｲｳｴｵｶｷｸ';
		$this->assertEqual($result, $expected);

		$string = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰｱｲｳｴｵｶｷｸ';
		$find = 'ｱ';
		$result = mb_stristr($string, $find, true);
		$expected = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰ';
		$this->assertEqual($result, $expected);

		$string = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$find = 'ﾊ';
		$result = mb_stristr($string, $find);
		$expected = 'ﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$this->assertEqual($result, $expected);

		$string = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$find = 'ﾊ';
		$result = mb_stristr($string, $find, true);
		$expected = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉ';
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'Ő';
		$result = mb_stristr($string, $find);
		$expected = 'őřļď!';
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'Ő';
		$result = mb_stristr($string, $find, true);
		$expected = 'Ĥēĺļŏ, Ŵ';
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'ĺļ';
		$result = mb_stristr($string, $find, true);
		$expected = 'Ĥē';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'O';
		$result = mb_stristr($string, $find);
		$expected = 'o, World!';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'O';
		$result = mb_stristr($string, $find, true);
		$expected = 'Hell';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'Wo';
		$result = mb_stristr($string, $find);
		$expected = 'World!';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'Wo';
		$result = mb_stristr($string, $find, true);
		$expected = 'Hello, ';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'll';
		$result = mb_stristr($string, $find);
		$expected = 'llo, World!';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'll';
		$result = mb_stristr($string, $find, true);
		$expected = 'He';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'rld';
		$result = mb_stristr($string, $find);
		$expected = 'rld!';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'rld';
		$result = mb_stristr($string, $find, true);
		$expected = 'Hello, Wo';
		$this->assertEqual($result, $expected);

		$string = 'čini';
		$find = 'N';
		$result = mb_stristr($string, $find);
		$expected = 'ni';
		$this->assertEqual($result, $expected);

		$string = 'čini';
		$find = 'N';
		$result = mb_stristr($string, $find, true);
		$expected = 'či';
		$this->assertEqual($result, $expected);

		$string = 'moći';
		$find = 'Ć';
		$result = mb_stristr($string, $find);
		$expected = 'ći';
		$this->assertEqual($result, $expected);

		$string = 'moći';
		$find = 'Ć';
		$result = mb_stristr($string, $find, true);
		$expected = 'mo';
		$this->assertEqual($result, $expected);

		$string = 'državni';
		$find = 'Ž';
		$result = mb_stristr($string, $find);
		$expected = 'žavni';
		$this->assertEqual($result, $expected);

		$string = 'državni';
		$find = 'Ž';
		$result = mb_stristr($string, $find, true);
		$expected = 'dr';
		$this->assertEqual($result, $expected);

		$string = '把百度设为首页';
		$find = '设';
		$result = mb_stristr($string, $find);
		$expected = '设为首页';
		$this->assertEqual($result, $expected);

		$string = '把百度设为首页';
		$find = '设';
		$result = mb_stristr($string, $find, true);
		$expected = '把百度';
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$find = '周';
		$result = mb_stristr($string, $find);
		$expected = '周永龍';
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$find = '周';
		$result = mb_stristr($string, $find, true);
		$expected = '一二三';
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$find = '二周';
		$result = mb_stristr($string, $find);
		$expected = false;
		$this->assertEqual($result, $expected);
	}

	function testMultibyteStristr() {
		$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$find = 'f';
		$result = Multibyte::stristr($string, $find);
		$expected = 'FGHIJKLMNOPQRSTUVWXYZ0123456789';
		$this->assertEqual($result, $expected);

		$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$find = 'f';
		$result = Multibyte::stristr($string, $find, true);
		$expected = 'ABCDE';
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$find = 'å';
		$result = Multibyte::stristr($string, $find);
		$expected = 'ÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$find = 'å';
		$result = Multibyte::stristr($string, $find, true);
		$expected = 'ÀÁÂÃÄ';
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$find = 'ċ';
		$result = Multibyte::stristr($string, $find);
		$expected = 'ĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$find = 'ċ';
		$result = Multibyte::stristr($string, $find, true);
		$expected = 'ĀĂĄĆĈ';
		$this->assertEqual($result, $expected);

		$string = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$find = 'f';
		$result = Multibyte::stristr($string, $find);
		$expected = 'FGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$this->assertEqual($result, $expected);

		$string = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$find = 'f';
		$result = Multibyte::stristr($string, $find, true);
		$expected = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDE';
		$this->assertEqual($result, $expected);

		$string = '¡¢£¤¥¦§¨©ª«¬­®¯°±²³´µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$find = 'Μ';
		$result = Multibyte::stristr($string, $find);
		$expected = 'µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$this->assertEqual($result, $expected);

		$string = '¡¢£¤¥¦§¨©ª«¬­®¯°±²³´µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$find = 'Μ';
		$result = Multibyte::stristr($string, $find, true);
		$expected = '¡¢£¤¥¦§¨©ª«¬­®¯°±²³´';
		$this->assertEqual($result, $expected);

		$string = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬ';
		$find = 'þ';
		$result = Multibyte::stristr($string, $find);
		$expected = 'Þßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬ';
		$this->assertEqual($result, $expected);

		$string = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬ';
		$find = 'þ';
		$result = Multibyte::stristr($string, $find, true);
		$expected = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝ';
		$this->assertEqual($result, $expected);

		$string = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃńŅņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$find = 'Ņ';
		$result = Multibyte::stristr($string, $find);
		$expected = 'ŅņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$this->assertEqual($result, $expected);

		$string = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃńŅņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$find = 'Ņ';
		$result = Multibyte::stristr($string, $find, true);
		$expected = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃń';
		$this->assertEqual($result, $expected);

		$string = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$find = 'Ƹ';
		$result = Multibyte::stristr($string, $find);
		$expected = 'ƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$this->assertEqual($result, $expected);

		$find = 'Ƹ';
		$result = Multibyte::stristr($string, $find, true);
		$expected = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷ';
		$this->assertEqual($result, $expected);

		$string = 'əɚɛɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$find = 'Ʀ';
		$result = Multibyte::stristr($string, $find);
		$expected = 'ʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$this->assertEqual($result, $expected);

		$string = 'əɚɛɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$find = 'Ʀ';
		$result = Multibyte::stristr($string, $find, true);
		$expected = 'əɚɛɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿ';
		$this->assertEqual($result, $expected);

		$string = 'ЀЁЂЃЄЅІЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$find = 'ї';
		$result = Multibyte::stristr($string, $find);
		$expected = 'ЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$this->assertEqual($result, $expected);

		$string = 'ЀЁЂЃЄЅІЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$find = 'ї';
		$result = Multibyte::stristr($string, $find, true);
		$expected = 'ЀЁЂЃЄЅІ';
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$find = 'Р';
		$result = Multibyte::stristr($string, $find);
		$expected = 'РСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$find = 'Р';
		$result = Multibyte::stristr($string, $find, true);
		$expected = 'МНОП';
		$this->assertEqual($result, $expected);

		$string = 'فقكلمنهوىيًٌٍَُ';
		$find = 'ن';
		$result = Multibyte::stristr($string, $find);
		$expected = 'نهوىيًٌٍَُ';
		$this->assertEqual($result, $expected);

		$string = 'فقكلمنهوىيًٌٍَُ';
		$find = 'ن';
		$result = Multibyte::stristr($string, $find, true);
		$expected = 'فقكلم';
		$this->assertEqual($result, $expected);

		$string = '✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾✿❀❁❂❃❄❅❆❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$find = '✿';
		$result = Multibyte::stristr($string, $find);
		$expected = '✿❀❁❂❃❄❅❆❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$this->assertEqual($result, $expected);

		$string = '✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾✿❀❁❂❃❄❅❆❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$find = '✿';
		$result = Multibyte::stristr($string, $find, true);
		$expected = '✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾';
		$this->assertEqual($result, $expected);

		$string = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺊⺋⺌⺍⺎⺏⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$find = '⺐';
		$result = Multibyte::stristr($string, $find);
		$expected = '⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$this->assertEqual($result, $expected);

		$string = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺊⺋⺌⺍⺎⺏⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$find = '⺐';
		$result = Multibyte::stristr($string, $find, true);
		$expected = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺊⺋⺌⺍⺎⺏';
		$this->assertEqual($result, $expected);

		$string = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$find = '⽤';
		$result = Multibyte::stristr($string, $find);
		$expected = '⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$this->assertEqual($result, $expected);

		$string = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$find = '⽤';
		$result = Multibyte::stristr($string, $find, true);
		$expected = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣';
		$this->assertEqual($result, $expected);

		$string = '눡눢눣눤눥눦눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕뉖뉗뉘뉙뉚뉛뉜뉝뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$find = '눻';
		$result = Multibyte::stristr($string, $find);
		$expected = '눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕뉖뉗뉘뉙뉚뉛뉜뉝뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$this->assertEqual($result, $expected);

		$string = '눡눢눣눤눥눦눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕뉖뉗뉘뉙뉚뉛뉜뉝뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$find = '눻';
		$result = Multibyte::stristr($string, $find, true);
		$expected = '눡눢눣눤눥눦눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺';
		$this->assertEqual($result, $expected);

		$string = 'ﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$find = 'ﺞ';
		$result = Multibyte::stristr($string, $find);
		$expected = 'ﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$this->assertEqual($result, $expected);

		$string = 'ﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$find = 'ﺞ';
		$result = Multibyte::stristr($string, $find, true);
		$expected = 'ﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝ';
		$this->assertEqual($result, $expected);

		$string = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻕﻖﻗﻘﻙﻚﻛﻜﻝﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻸﻹﻺﻻﻼ';
		$find = 'ﻞ';
		$result = Multibyte::stristr($string, $find);
		$expected = 'ﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻸﻹﻺﻻﻼ';
		$this->assertEqual($result, $expected);

		$string = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻕﻖﻗﻘﻙﻚﻛﻜﻝﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻸﻹﻺﻻﻼ';
		$find = 'ﻞ';
		$result = Multibyte::stristr($string, $find, true);
		$expected = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻕﻖﻗﻘﻙﻚﻛﻜﻝ';
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'Ｋ';
		$result = Multibyte::stristr($string, $find);
		$expected = 'ｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'Ｋ';
		$result = Multibyte::stristr($string, $find, true);
		$expected = 'ａｂｃｄｅｆｇｈｉｊ';
		$this->assertEqual($result, $expected);

		$string = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰｱｲｳｴｵｶｷｸ';
		$find = 'ｱ';
		$result = Multibyte::stristr($string, $find);
		$expected = 'ｱｲｳｴｵｶｷｸ';
		$this->assertEqual($result, $expected);

		$string = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰｱｲｳｴｵｶｷｸ';
		$find = 'ｱ';
		$result = Multibyte::stristr($string, $find, true);
		$expected = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰ';
		$this->assertEqual($result, $expected);

		$string = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$find = 'ﾊ';
		$result = Multibyte::stristr($string, $find);
		$expected = 'ﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$this->assertEqual($result, $expected);

		$string = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$find = 'ﾊ';
		$result = Multibyte::stristr($string, $find, true);
		$expected = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉ';
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'Ő';
		$result = Multibyte::stristr($string, $find);
		$expected = 'őřļď!';
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'Ő';
		$result = Multibyte::stristr($string, $find, true);
		$expected = 'Ĥēĺļŏ, Ŵ';
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'ĺļ';
		$result = Multibyte::stristr($string, $find, true);
		$expected = 'Ĥē';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'O';
		$result = Multibyte::stristr($string, $find);
		$expected = 'o, World!';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'O';
		$result = Multibyte::stristr($string, $find, true);
		$expected = 'Hell';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'Wo';
		$result = Multibyte::stristr($string, $find);
		$expected = 'World!';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'Wo';
		$result = Multibyte::stristr($string, $find, true);
		$expected = 'Hello, ';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'll';
		$result = Multibyte::stristr($string, $find);
		$expected = 'llo, World!';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'll';
		$result = Multibyte::stristr($string, $find, true);
		$expected = 'He';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'rld';
		$result = Multibyte::stristr($string, $find);
		$expected = 'rld!';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'rld';
		$result = Multibyte::stristr($string, $find, true);
		$expected = 'Hello, Wo';
		$this->assertEqual($result, $expected);

		$string = 'čini';
		$find = 'N';
		$result = Multibyte::stristr($string, $find);
		$expected = 'ni';
		$this->assertEqual($result, $expected);

		$string = 'čini';
		$find = 'N';
		$result = Multibyte::stristr($string, $find, true);
		$expected = 'či';
		$this->assertEqual($result, $expected);

		$string = 'moći';
		$find = 'Ć';
		$result = Multibyte::stristr($string, $find);
		$expected = 'ći';
		$this->assertEqual($result, $expected);

		$string = 'moći';
		$find = 'Ć';
		$result = Multibyte::stristr($string, $find, true);
		$expected = 'mo';
		$this->assertEqual($result, $expected);

		$string = 'državni';
		$find = 'Ž';
		$result = Multibyte::stristr($string, $find);
		$expected = 'žavni';
		$this->assertEqual($result, $expected);

		$string = 'državni';
		$find = 'Ž';
		$result = Multibyte::stristr($string, $find, true);
		$expected = 'dr';
		$this->assertEqual($result, $expected);

		$string = '把百度设为首页';
		$find = '设';
		$result = Multibyte::stristr($string, $find);
		$expected = '设为首页';
		$this->assertEqual($result, $expected);

		$string = '把百度设为首页';
		$find = '设';
		$result = Multibyte::stristr($string, $find, true);
		$expected = '把百度';
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$find = '周';
		$result = Multibyte::stristr($string, $find);
		$expected = '周永龍';
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$find = '周';
		$result = Multibyte::stristr($string, $find, true);
		$expected = '一二三';
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$find = '二周';
		$result = Multibyte::stristr($string, $find);
		$expected = false;
		$this->assertEqual($result, $expected);
	}

	function testUsingMbStrlen() {
		$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$result = mb_strlen($string);
		$expected = 36;
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$result = mb_strlen($string);
		$expected = 30;
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$result = mb_strlen($string);
		$expected = 61;
		$this->assertEqual($result, $expected);

		$string = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$result = mb_strlen($string);
		$expected = 94;
		$this->assertEqual($result, $expected);

		$string = '¡¢£¤¥¦§¨©ª«¬­®¯°±²³´µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$result = mb_strlen($string);
		$expected = 40;
		$this->assertEqual($result, $expected);

		$string = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬ';
		$result = mb_strlen($string);
		$expected = 100;
		$this->assertEqual($result, $expected);

		$string = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃńŅņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$result = mb_strlen($string);
		$expected = 100;
		$this->assertEqual($result, $expected);

		$string = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$result = mb_strlen($string);
		$expected = 100;
		$this->assertEqual($result, $expected);

		$string = 'əɚɛɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$result = mb_strlen($string);
		$expected = 100;
		$this->assertEqual($result, $expected);

		$string = 'ЀЁЂЃЄЅІЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$result = mb_strlen($string);
		$expected = 28;
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$result = mb_strlen($string);
		$expected = 49;
		$this->assertEqual($result, $expected);

		$string = 'فقكلمنهوىيًٌٍَُ';
		$result = mb_strlen($string);
		$expected = 15;
		$this->assertEqual($result, $expected);

		$string = '✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾✿❀❁❂❃❄❅❆❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$result = mb_strlen($string);
		$expected = 47;
		$this->assertEqual($result, $expected);

		$string = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺊⺋⺌⺍⺎⺏⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$result = mb_strlen($string);
		$expected = 96;
		$this->assertEqual($result, $expected);

		$string = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$result = mb_strlen($string);
		$expected = 59;
		$this->assertEqual($result, $expected);

		$string = '눡눢눣눤눥눦눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕뉖뉗뉘뉙뉚뉛뉜뉝뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$result = mb_strlen($string);
		$expected = 100;
		$this->assertEqual($result, $expected);

		$string = 'ﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$result = mb_strlen($string);
		$expected = 65;
		$this->assertEqual($result, $expected);

		$string = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻕﻖﻗﻘﻙﻚﻛﻜﻝﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻸﻹﻺﻻﻼ';
		$result = mb_strlen($string);
		$expected = 76;
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$result = mb_strlen($string);
		$expected = 26;
		$this->assertEqual($result, $expected);

		$string = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰｱｲｳｴｵｶｷｸ';
		$result = mb_strlen($string);
		$expected = 24;
		$this->assertEqual($result, $expected);

		$string = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$result = mb_strlen($string);
		$expected = 38;
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$result = mb_strlen($string);
		$expected = 13;
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$result = mb_strlen($string);
		$expected = 13;
		$this->assertEqual($result, $expected);

		$string = 'čini';
		$result = mb_strlen($string);
		$expected = 4;
		$this->assertEqual($result, $expected);

		$string = 'moći';
		$result = mb_strlen($string);
		$expected = 4;
		$this->assertEqual($result, $expected);

		$string = 'državni';
		$result = mb_strlen($string);
		$expected = 7;
		$this->assertEqual($result, $expected);

		$string = '把百度设为首页';
		$result = mb_strlen($string);
		$expected = 7;
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$result = mb_strlen($string);
		$expected = 6;
		$this->assertEqual($result, $expected);
	}

	function testMultibyteStrlen() {
		$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$result = Multibyte::strlen($string);
		$expected = 36;
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$result = Multibyte::strlen($string);
		$expected = 30;
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$result = Multibyte::strlen($string);
		$expected = 61;
		$this->assertEqual($result, $expected);

		$string = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$result = Multibyte::strlen($string);
		$expected = 94;
		$this->assertEqual($result, $expected);

		$string = '¡¢£¤¥¦§¨©ª«¬­®¯°±²³´µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$result = Multibyte::strlen($string);
		$expected = 40;
		$this->assertEqual($result, $expected);

		$string = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬ';
		$result = Multibyte::strlen($string);
		$expected = 100;
		$this->assertEqual($result, $expected);

		$string = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃńŅņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$result = Multibyte::strlen($string);
		$expected = 100;
		$this->assertEqual($result, $expected);

		$string = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$result = Multibyte::strlen($string);
		$expected = 100;
		$this->assertEqual($result, $expected);

		$string = 'əɚɛɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$result = Multibyte::strlen($string);
		$expected = 100;
		$this->assertEqual($result, $expected);

		$string = 'ЀЁЂЃЄЅІЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$result = Multibyte::strlen($string);
		$expected = 28;
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$result = Multibyte::strlen($string);
		$expected = 49;
		$this->assertEqual($result, $expected);

		$string = 'فقكلمنهوىيًٌٍَُ';
		$result = Multibyte::strlen($string);
		$expected = 15;
		$this->assertEqual($result, $expected);

		$string = '✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾✿❀❁❂❃❄❅❆❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$result = Multibyte::strlen($string);
		$expected = 47;
		$this->assertEqual($result, $expected);

		$string = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺊⺋⺌⺍⺎⺏⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$result = Multibyte::strlen($string);
		$expected = 96;
		$this->assertEqual($result, $expected);

		$string = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$result = Multibyte::strlen($string);
		$expected = 59;
		$this->assertEqual($result, $expected);

		$string = '눡눢눣눤눥눦눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕뉖뉗뉘뉙뉚뉛뉜뉝뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$result = Multibyte::strlen($string);
		$expected = 100;
		$this->assertEqual($result, $expected);

		$string = 'ﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$result = Multibyte::strlen($string);
		$expected = 65;
		$this->assertEqual($result, $expected);

		$string = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻕﻖﻗﻘﻙﻚﻛﻜﻝﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻸﻹﻺﻻﻼ';
		$result = Multibyte::strlen($string);
		$expected = 76;
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$result = Multibyte::strlen($string);
		$expected = 26;
		$this->assertEqual($result, $expected);

		$string = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰｱｲｳｴｵｶｷｸ';
		$result = Multibyte::strlen($string);
		$expected = 24;
		$this->assertEqual($result, $expected);

		$string = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$result = Multibyte::strlen($string);
		$expected = 38;
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$result = Multibyte::strlen($string);
		$expected = 13;
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$result = Multibyte::strlen($string);
		$expected = 13;
		$this->assertEqual($result, $expected);

		$string = 'čini';
		$result = Multibyte::strlen($string);
		$expected = 4;
		$this->assertEqual($result, $expected);

		$string = 'moći';
		$result = Multibyte::strlen($string);
		$expected = 4;
		$this->assertEqual($result, $expected);

		$string = 'državni';
		$result = Multibyte::strlen($string);
		$expected = 7;
		$this->assertEqual($result, $expected);

		$string = '把百度设为首页';
		$result = Multibyte::strlen($string);
		$expected = 7;
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$result = Multibyte::strlen($string);
		$expected = 6;
		$this->assertEqual($result, $expected);
	}

	function testUsingMbStrpos() {
		$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$find = 'F';
		$result = mb_strpos($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'ABCDEFGHIJKLMNOPQFRSTUVWXYZ0123456789';
		$find = 'F';
		$result = mb_strpos($string, $find, 6);
		$expected = 17;
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$find = 'Å';
		$result = mb_strpos($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÅÙÚÛÜÝÞ';
		$find = 'Å';
		$result = mb_strpos($string, $find, 6);
		$expected = 24;
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$find = 'Ċ';
		$result = mb_strpos($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁĊŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$find = 'Ċ';
		$result = mb_strpos($string, $find, 6);
		$expected = 32;
		$this->assertEqual($result, $expected);

		$string = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$find = 'F';
		$result = mb_strpos($string, $find);
		$expected = 37;
		$this->assertEqual($result, $expected);

		$string = '¡¢£¤¥¦§¨©ª«¬­®¯°±²³´µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$find = 'µ';
		$result = mb_strpos($string, $find);
		$expected = 20;
		$this->assertEqual($result, $expected);

		$string = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬ';
		$find = 'é';
		$result = mb_strpos($string, $find);
		$expected = 32;
		$this->assertEqual($result, $expected);

		$string = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃńŅņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$find = 'Ņ';
		$result = mb_strpos($string, $find);
		$expected = 24;
		$this->assertEqual($result, $expected);

		$string = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$find = 'Ƹ';
		$result = mb_strpos($string, $find);
		$expected = 39;
		$this->assertEqual($result, $expected);

		$string = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$find = 'ƹ';
		$result = mb_strpos($string, $find);
		$expected = 40;
		$this->assertEqual($result, $expected);

		$string = 'əɚɛɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$find = 'ʀ';
		$result = mb_strpos($string, $find);
		$expected = 39;
		$this->assertEqual($result, $expected);

		$string = 'ЀЁЂЃЄЅІЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$find = 'Ї';
		$result = mb_strpos($string, $find);
		$expected = 7;
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$find = 'Р';
		$result = mb_strpos($string, $find);
		$expected = 4;
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$find = 'р';
		$result = mb_strpos($string, $find, 5);
		$expected = 36;
		$this->assertEqual($result, $expected);

		$string = 'فقكلمنهوىيًٌٍَُ';
		$find = 'ن';
		$result = mb_strpos($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = '✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾✿❀❁❂❃❄❅❆❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$find = '✿';
		$result = mb_strpos($string, $find);
		$expected = 15;
		$this->assertEqual($result, $expected);

		$string = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺊⺋⺌⺍⺎⺏⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$find = '⺐';
		$result = mb_strpos($string, $find);
		$expected = 16;
		$this->assertEqual($result, $expected);

		$string = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$find = '⽤';
		$result = mb_strpos($string, $find);
		$expected = 31;
		$this->assertEqual($result, $expected);

		$string = '눡눢눣눤눥눦눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕뉖뉗뉘뉙뉚뉛뉜뉝뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$find = '눻';
		$result = mb_strpos($string, $find);
		$expected = 26;
		$this->assertEqual($result, $expected);

		$string = 'ﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$find = 'ﺞ';
		$result = mb_strpos($string, $find);
		$expected = 46;
		$this->assertEqual($result, $expected);

		$string = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻕﻖﻗﻘﻙﻚﻛﻜﻝﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻸﻹﻺﻻﻼ';
		$find = 'ﻞ';
		$result = mb_strpos($string, $find);
		$expected = 45;
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'ｋ';
		$result = mb_strpos($string, $find);
		$expected = 10;
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'ｋ';
		$result = mb_strpos($string, $find);
		$expected = 10;
		$this->assertEqual($result, $expected);

		$string = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰｱｲｳｴｵｶｷｸ';
		$find = 'ｱ';
		$result = mb_strpos($string, $find);
		$expected = 16;
		$this->assertEqual($result, $expected);

		$string = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$find = 'ﾊ';
		$result = mb_strpos($string, $find);
		$expected = 17;
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'ő';
		$result = mb_strpos($string, $find);
		$expected = 8;
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'ő';
		$result = mb_strpos($string, $find);
		$expected = 8;
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'őř';
		$result = mb_strpos($string, $find);
		$expected = 8;
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'o';
		$result = mb_strpos($string, $find);
		$expected = 4;
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'o';
		$result = mb_strpos($string, $find, 5);
		$expected = 8;
		$this->assertEqual($result, $expected);

		$string = 'čini';
		$find = 'n';
		$result = mb_strpos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = 'čini';
		$find = 'n';
		$result = mb_strpos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = 'moći';
		$find = 'ć';
		$result = mb_strpos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = 'moći';
		$find = 'ć';
		$result = mb_strpos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = 'državni';
		$find = 'ž';
		$result = mb_strpos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = '把百度设为首页';
		$find = '设';
		$result = mb_strpos($string, $find);
		$expected = 3;
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$find = '周';
		$result = mb_strpos($string, $find);
		$expected = 3;
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$find = '一周';
		$result = mb_strpos($string, $find);
		$expected = false;
		$this->assertEqual($result, $expected);
	}

	function testMultibyteStrpos() {
		$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$find = 'F';
		$result = Multibyte::strpos($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'ABCDEFGHIJKLMNOPQFRSTUVWXYZ0123456789';
		$find = 'F';
		$result = Multibyte::strpos($string, $find, 6);
		$expected = 17;
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$find = 'Å';
		$result = Multibyte::strpos($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÅÙÚÛÜÝÞ';
		$find = 'Å';
		$result = Multibyte::strpos($string, $find, 6);
		$expected = 24;
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$find = 'Ċ';
		$result = Multibyte::strpos($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁĊŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$find = 'Ċ';
		$result = Multibyte::strpos($string, $find, 6);
		$expected = 32;
		$this->assertEqual($result, $expected);

		$string = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$find = 'F';
		$result = Multibyte::strpos($string, $find);
		$expected = 37;
		$this->assertEqual($result, $expected);

		$string = '¡¢£¤¥¦§¨©ª«¬­®¯°±²³´µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$find = 'µ';
		$result = Multibyte::strpos($string, $find);
		$expected = 20;
		$this->assertEqual($result, $expected);

		$string = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬ';
		$find = 'é';
		$result = Multibyte::strpos($string, $find);
		$expected = 32;
		$this->assertEqual($result, $expected);

		$string = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃńŅņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$find = 'Ņ';
		$result = Multibyte::strpos($string, $find);
		$expected = 24;
		$this->assertEqual($result, $expected);

		$string = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$find = 'Ƹ';
		$result = Multibyte::strpos($string, $find);
		$expected = 39;
		$this->assertEqual($result, $expected);

		$string = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$find = 'ƹ';
		$result = Multibyte::strpos($string, $find);
		$expected = 40;
		$this->assertEqual($result, $expected);

		$string = 'əɚɛɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$find = 'ʀ';
		$result = Multibyte::strpos($string, $find);
		$expected = 39;
		$this->assertEqual($result, $expected);

		$string = 'ЀЁЂЃЄЅІЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$find = 'Ї';
		$result = Multibyte::strpos($string, $find);
		$expected = 7;
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$find = 'Р';
		$result = Multibyte::strpos($string, $find);
		$expected = 4;
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$find = 'р';
		$result = Multibyte::strpos($string, $find, 5);
		$expected = 36;
		$this->assertEqual($result, $expected);

		$string = 'فقكلمنهوىيًٌٍَُ';
		$find = 'ن';
		$result = Multibyte::strpos($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = '✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾✿❀❁❂❃❄❅❆❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$find = '✿';
		$result = Multibyte::strpos($string, $find);
		$expected = 15;
		$this->assertEqual($result, $expected);

		$string = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺊⺋⺌⺍⺎⺏⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$find = '⺐';
		$result = Multibyte::strpos($string, $find);
		$expected = 16;
		$this->assertEqual($result, $expected);

		$string = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$find = '⽤';
		$result = Multibyte::strpos($string, $find);
		$expected = 31;
		$this->assertEqual($result, $expected);

		$string = '눡눢눣눤눥눦눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕뉖뉗뉘뉙뉚뉛뉜뉝뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$find = '눻';
		$result = Multibyte::strpos($string, $find);
		$expected = 26;
		$this->assertEqual($result, $expected);

		$string = 'ﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$find = 'ﺞ';
		$result = Multibyte::strpos($string, $find);
		$expected = 46;
		$this->assertEqual($result, $expected);

		$string = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻕﻖﻗﻘﻙﻚﻛﻜﻝﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻸﻹﻺﻻﻼ';
		$find = 'ﻞ';
		$result = Multibyte::strpos($string, $find);
		$expected = 45;
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'ｋ';
		$result = Multibyte::strpos($string, $find);
		$expected = 10;
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'ｋ';
		$result = Multibyte::strpos($string, $find);
		$expected = 10;
		$this->assertEqual($result, $expected);

		$string = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰｱｲｳｴｵｶｷｸ';
		$find = 'ｱ';
		$result = Multibyte::strpos($string, $find);
		$expected = 16;
		$this->assertEqual($result, $expected);

		$string = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$find = 'ﾊ';
		$result = Multibyte::strpos($string, $find);
		$expected = 17;
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'ő';
		$result = Multibyte::strpos($string, $find);
		$expected = 8;
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'ő';
		$result = Multibyte::strpos($string, $find);
		$expected = 8;
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'őř';
		$result = Multibyte::strpos($string, $find);
		$expected = 8;
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'o';
		$result = Multibyte::strpos($string, $find);
		$expected = 4;
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'o';
		$result = Multibyte::strpos($string, $find, 5);
		$expected = 8;
		$this->assertEqual($result, $expected);

		$string = 'čini';
		$find = 'n';
		$result = Multibyte::strpos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = 'čini';
		$find = 'n';
		$result = Multibyte::strpos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = 'moći';
		$find = 'ć';
		$result = Multibyte::strpos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = 'moći';
		$find = 'ć';
		$result = Multibyte::strpos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = 'državni';
		$find = 'ž';
		$result = Multibyte::strpos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = '把百度设为首页';
		$find = '设';
		$result = Multibyte::strpos($string, $find);
		$expected = 3;
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$find = '周';
		$result = Multibyte::strpos($string, $find);
		$expected = 3;
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$find = '一周';
		$result = Multibyte::strpos($string, $find);
		$expected = false;
		$this->assertEqual($result, $expected);
	}

	function testUsingMbStrrchr() {
		$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$find = 'F';
		$result = mb_strrchr($string, $find);
		$expected = 'FGHIJKLMNOPQRSTUVWXYZ0123456789';
		$this->assertEqual($result, $expected);

		$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$find = 'F';
		$result = mb_strrchr($string, $find, true);
		$expected = 'ABCDE';
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$find = 'Å';
		$result = mb_strrchr($string, $find);
		$expected = 'ÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$find = 'Å';
		$result = mb_strrchr($string, $find, true);
		$expected = 'ÀÁÂÃÄ';
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$find = 'Ċ';
		$result = mb_strrchr($string, $find);
		$expected = 'ĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$find = 'Ċ';
		$result = mb_strrchr($string, $find, true);
		$expected = 'ĀĂĄĆĈ';
		$this->assertEqual($result, $expected);

		$string = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$find = 'F';
		$result = mb_strrchr($string, $find);
		$expected = 'FGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$this->assertEqual($result, $expected);

		$string = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$find = 'F';
		$result = mb_strrchr($string, $find, true);
		$expected = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDE';
		$this->assertEqual($result, $expected);

		$string = '¡¢£¤¥¦§¨©ª«¬­®¯°±²³´µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$find = 'µ';
		$result = mb_strrchr($string, $find);
		$expected = 'µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$this->assertEqual($result, $expected);

		$string = '¡¢£¤¥¦§¨©ª«¬­®¯°±²³´µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$find = 'µ';
		$result = mb_strrchr($string, $find, true);
		$expected = '¡¢£¤¥¦§¨©ª«¬­®¯°±²³´';
		$this->assertEqual($result, $expected);

		$string = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬ';
		$find = 'Þ';
		$result = mb_strrchr($string, $find);
		$expected = 'Þßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬ';
		$this->assertEqual($result, $expected);

		$string = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬ';
		$find = 'Þ';
		$result = mb_strrchr($string, $find, true);
		$expected = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝ';
		$this->assertEqual($result, $expected);

		$string = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃńŅņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$find = 'Ņ';
		$result = mb_strrchr($string, $find);
		$expected = 'ŅņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$this->assertEqual($result, $expected);

		$string = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃńŅņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$find = 'Ņ';
		$result = mb_strrchr($string, $find, true);
		$expected = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃń';
		$this->assertEqual($result, $expected);

		$string = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$find = 'Ƹ';
		$result = mb_strrchr($string, $find);
		$expected = 'ƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$this->assertEqual($result, $expected);

		$find = 'Ƹ';
		$result = mb_strrchr($string, $find, true);
		$expected = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷ';
		$this->assertEqual($result, $expected);

		$string = 'əɚɛɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$find = 'ʀ';
		$result = mb_strrchr($string, $find);
		$expected = 'ʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$this->assertEqual($result, $expected);

		$string = 'əɚɛɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$find = 'ʀ';
		$result = mb_strrchr($string, $find, true);
		$expected = 'əɚɛɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿ';
		$this->assertEqual($result, $expected);

		$string = 'ЀЁЂЃЄЅІЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$find = 'Ї';
		$result = mb_strrchr($string, $find);
		$expected = 'ЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$this->assertEqual($result, $expected);

		$string = 'ЀЁЂЃЄЅІЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$find = 'Ї';
		$result = mb_strrchr($string, $find, true);
		$expected = 'ЀЁЂЃЄЅІ';
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$find = 'Р';
		$result = mb_strrchr($string, $find);
		$expected = 'РСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$find = 'Р';
		$result = mb_strrchr($string, $find, true);
		$expected = 'МНОП';
		$this->assertEqual($result, $expected);

		$string = 'فقكلمنهوىيًٌٍَُ';
		$find = 'ن';
		$result = mb_strrchr($string, $find);
		$expected = 'نهوىيًٌٍَُ';
		$this->assertEqual($result, $expected);

		$string = 'فقكلمنهوىيًٌٍَُ';
		$find = 'ن';
		$result = mb_strrchr($string, $find, true);
		$expected = 'فقكلم';
		$this->assertEqual($result, $expected);

		$string = '✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾✿❀❁❂❃❄❅❆❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$find = '✿';
		$result = mb_strrchr($string, $find);
		$expected = '✿❀❁❂❃❄❅❆❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$this->assertEqual($result, $expected);

		$string = '✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾✿❀❁❂❃❄❅❆❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$find = '✿';
		$result = mb_strrchr($string, $find, true);
		$expected = '✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾';
		$this->assertEqual($result, $expected);

		$string = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺊⺋⺌⺍⺎⺏⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$find = '⺐';
		$result = mb_strrchr($string, $find);
		$expected = '⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$this->assertEqual($result, $expected);

		$string = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺊⺋⺌⺍⺎⺏⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$find = '⺐';
		$result = mb_strrchr($string, $find, true);
		$expected = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺊⺋⺌⺍⺎⺏';
		$this->assertEqual($result, $expected);

		$string = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$find = '⽤';
		$result = mb_strrchr($string, $find);
		$expected = '⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$this->assertEqual($result, $expected);

		$string = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$find = '⽤';
		$result = mb_strrchr($string, $find, true);
		$expected = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣';
		$this->assertEqual($result, $expected);

		$string = '눡눢눣눤눥눦눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕뉖뉗뉘뉙뉚뉛뉜뉝뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$find = '눻';
		$result = mb_strrchr($string, $find);
		$expected = '눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕뉖뉗뉘뉙뉚뉛뉜뉝뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$this->assertEqual($result, $expected);

		$string = '눡눢눣눤눥눦눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕뉖뉗뉘뉙뉚뉛뉜뉝뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$find = '눻';
		$result = mb_strrchr($string, $find, true);
		$expected = '눡눢눣눤눥눦눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺';
		$this->assertEqual($result, $expected);

		$string = 'ﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$find = 'ﺞ';
		$result = mb_strrchr($string, $find);
		$expected = 'ﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$this->assertEqual($result, $expected);

		$string = 'ﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$find = 'ﺞ';
		$result = mb_strrchr($string, $find, true);
		$expected = 'ﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝ';
		$this->assertEqual($result, $expected);

		$string = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻕﻖﻗﻘﻙﻚﻛﻜﻝﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻸﻹﻺﻻﻼ';
		$find = 'ﻞ';
		$result = mb_strrchr($string, $find);
		$expected = 'ﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻸﻹﻺﻻﻼ';
		$this->assertEqual($result, $expected);

		$string = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻕﻖﻗﻘﻙﻚﻛﻜﻝﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻸﻹﻺﻻﻼ';
		$find = 'ﻞ';
		$result = mb_strrchr($string, $find, true);
		$expected = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻕﻖﻗﻘﻙﻚﻛﻜﻝ';
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'ｋ';
		$result = mb_strrchr($string, $find);
		$expected = 'ｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'ｋ';
		$result = mb_strrchr($string, $find, true);
		$expected = 'ａｂｃｄｅｆｇｈｉｊ';
		$this->assertEqual($result, $expected);

		$string = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰｱｲｳｴｵｶｷｸ';
		$find = 'ｱ';
		$result = mb_strrchr($string, $find);
		$expected = 'ｱｲｳｴｵｶｷｸ';
		$this->assertEqual($result, $expected);

		$string = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰｱｲｳｴｵｶｷｸ';
		$find = 'ｱ';
		$result = mb_strrchr($string, $find, true);
		$expected = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰ';
		$this->assertEqual($result, $expected);

		$string = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$find = 'ﾊ';
		$result = mb_strrchr($string, $find);
		$expected = 'ﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$this->assertEqual($result, $expected);

		$string = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$find = 'ﾊ';
		$result = mb_strrchr($string, $find, true);
		$expected = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉ';
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'ő';
		$result = mb_strrchr($string, $find);
		$expected = 'őřļď!';
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'ő';
		$result = mb_strrchr($string, $find, true);
		$expected = 'Ĥēĺļŏ, Ŵ';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'o';
		$result = mb_strrchr($string, $find);
		$expected = 'orld!';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'o';
		$result = mb_strrchr($string, $find, true);
		$expected = 'Hello, W';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'Wo';
		$result = mb_strrchr($string, $find);
		$expected = 'World!';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'Wo';
		$result = mb_strrchr($string, $find, true);
		$expected = 'Hello, ';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'll';
		$result = mb_strrchr($string, $find);
		$expected = 'llo, World!';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'll';
		$result = mb_strrchr($string, $find, true);
		$expected = 'He';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'rld';
		$result = mb_strrchr($string, $find);
		$expected = 'rld!';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'rld';
		$result = mb_strrchr($string, $find, true);
		$expected = 'Hello, Wo';
		$this->assertEqual($result, $expected);

		$string = 'čini';
		$find = 'n';
		$result = mb_strrchr($string, $find);
		$expected = 'ni';
		$this->assertEqual($result, $expected);

		$string = 'čini';
		$find = 'n';
		$result = mb_strrchr($string, $find, true);
		$expected = 'či';
		$this->assertEqual($result, $expected);

		$string = 'moći';
		$find = 'ć';
		$result = mb_strrchr($string, $find);
		$expected = 'ći';
		$this->assertEqual($result, $expected);

		$string = 'moći';
		$find = 'ć';
		$result = mb_strrchr($string, $find, true);
		$expected = 'mo';
		$this->assertEqual($result, $expected);

		$string = 'državni';
		$find = 'ž';
		$result = mb_strrchr($string, $find);
		$expected = 'žavni';
		$this->assertEqual($result, $expected);

		$string = 'državni';
		$find = 'ž';
		$result = mb_strrchr($string, $find, true);
		$expected = 'dr';
		$this->assertEqual($result, $expected);

		$string = '把百度设为首页';
		$find = '设';
		$result = mb_strrchr($string, $find);
		$expected = '设为首页';
		$this->assertEqual($result, $expected);

		$string = '把百度设为首页';
		$find = '设';
		$result = mb_strrchr($string, $find, true);
		$expected = '把百度';
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$find = '周';
		$result = mb_strrchr($string, $find);
		$expected = '周永龍';
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$find = '周';
		$result = mb_strrchr($string, $find, true);
		$expected = '一二三';
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$find = '周龍';
		$result = mb_strrchr($string, $find, true);
		$expected = false;
		$this->assertEqual($result, $expected);
	}

	function testMultibyteStrrchr() {
		$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$find = 'F';
		$result = Multibyte::strrchr($string, $find);
		$expected = 'FGHIJKLMNOPQRSTUVWXYZ0123456789';
		$this->assertEqual($result, $expected);

		$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$find = 'F';
		$result = Multibyte::strrchr($string, $find, true);
		$expected = 'ABCDE';
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$find = 'Å';
		$result = Multibyte::strrchr($string, $find);
		$expected = 'ÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$find = 'Å';
		$result = Multibyte::strrchr($string, $find, true);
		$expected = 'ÀÁÂÃÄ';
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$find = 'Ċ';
		$result = Multibyte::strrchr($string, $find);
		$expected = 'ĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$find = 'Ċ';
		$result = Multibyte::strrchr($string, $find, true);
		$expected = 'ĀĂĄĆĈ';
		$this->assertEqual($result, $expected);

		$string = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$find = 'F';
		$result = Multibyte::strrchr($string, $find);
		$expected = 'FGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$this->assertEqual($result, $expected);

		$string = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$find = 'F';
		$result = Multibyte::strrchr($string, $find, true);
		$expected = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDE';
		$this->assertEqual($result, $expected);

		$string = '¡¢£¤¥¦§¨©ª«¬­®¯°±²³´µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$find = 'µ';
		$result = Multibyte::strrchr($string, $find);
		$expected = 'µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$this->assertEqual($result, $expected);

		$string = '¡¢£¤¥¦§¨©ª«¬­®¯°±²³´µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$find = 'µ';
		$result = Multibyte::strrchr($string, $find, true);
		$expected = '¡¢£¤¥¦§¨©ª«¬­®¯°±²³´';
		$this->assertEqual($result, $expected);

		$string = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬ';
		$find = 'Þ';
		$result = Multibyte::strrchr($string, $find);
		$expected = 'Þßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬ';
		$this->assertEqual($result, $expected);

		$string = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬ';
		$find = 'Þ';
		$result = Multibyte::strrchr($string, $find, true);
		$expected = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝ';
		$this->assertEqual($result, $expected);

		$string = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃńŅņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$find = 'Ņ';
		$result = Multibyte::strrchr($string, $find);
		$expected = 'ŅņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$this->assertEqual($result, $expected);

		$string = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃńŅņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$find = 'Ņ';
		$result = Multibyte::strrchr($string, $find, true);
		$expected = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃń';
		$this->assertEqual($result, $expected);

		$string = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$find = 'Ƹ';
		$result = Multibyte::strrchr($string, $find);
		$expected = 'ƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$this->assertEqual($result, $expected);

		$find = 'Ƹ';
		$result = Multibyte::strrchr($string, $find, true);
		$expected = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷ';
		$this->assertEqual($result, $expected);

		$string = 'əɚɛɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$find = 'ʀ';
		$result = Multibyte::strrchr($string, $find);
		$expected = 'ʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$this->assertEqual($result, $expected);

		$string = 'əɚɛɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$find = 'ʀ';
		$result = Multibyte::strrchr($string, $find, true);
		$expected = 'əɚɛɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿ';
		$this->assertEqual($result, $expected);

		$string = 'ЀЁЂЃЄЅІЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$find = 'Ї';
		$result = Multibyte::strrchr($string, $find);
		$expected = 'ЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$this->assertEqual($result, $expected);

		$string = 'ЀЁЂЃЄЅІЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$find = 'Ї';
		$result = Multibyte::strrchr($string, $find, true);
		$expected = 'ЀЁЂЃЄЅІ';
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$find = 'Р';
		$result = Multibyte::strrchr($string, $find);
		$expected = 'РСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$find = 'Р';
		$result = Multibyte::strrchr($string, $find, true);
		$expected = 'МНОП';
		$this->assertEqual($result, $expected);

		$string = 'فقكلمنهوىيًٌٍَُ';
		$find = 'ن';
		$result = Multibyte::strrchr($string, $find);
		$expected = 'نهوىيًٌٍَُ';
		$this->assertEqual($result, $expected);

		$string = 'فقكلمنهوىيًٌٍَُ';
		$find = 'ن';
		$result = Multibyte::strrchr($string, $find, true);
		$expected = 'فقكلم';
		$this->assertEqual($result, $expected);

		$string = '✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾✿❀❁❂❃❄❅❆❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$find = '✿';
		$result = Multibyte::strrchr($string, $find);
		$expected = '✿❀❁❂❃❄❅❆❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$this->assertEqual($result, $expected);

		$string = '✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾✿❀❁❂❃❄❅❆❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$find = '✿';
		$result = Multibyte::strrchr($string, $find, true);
		$expected = '✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾';
		$this->assertEqual($result, $expected);

		$string = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺊⺋⺌⺍⺎⺏⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$find = '⺐';
		$result = Multibyte::strrchr($string, $find);
		$expected = '⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$this->assertEqual($result, $expected);

		$string = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺊⺋⺌⺍⺎⺏⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$find = '⺐';
		$result = Multibyte::strrchr($string, $find, true);
		$expected = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺊⺋⺌⺍⺎⺏';
		$this->assertEqual($result, $expected);

		$string = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$find = '⽤';
		$result = Multibyte::strrchr($string, $find);
		$expected = '⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$this->assertEqual($result, $expected);

		$string = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$find = '⽤';
		$result = Multibyte::strrchr($string, $find, true);
		$expected = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣';
		$this->assertEqual($result, $expected);

		$string = '눡눢눣눤눥눦눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕뉖뉗뉘뉙뉚뉛뉜뉝뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$find = '눻';
		$result = Multibyte::strrchr($string, $find);
		$expected = '눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕뉖뉗뉘뉙뉚뉛뉜뉝뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$this->assertEqual($result, $expected);

		$string = '눡눢눣눤눥눦눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕뉖뉗뉘뉙뉚뉛뉜뉝뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$find = '눻';
		$result = Multibyte::strrchr($string, $find, true);
		$expected = '눡눢눣눤눥눦눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺';
		$this->assertEqual($result, $expected);

		$string = 'ﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$find = 'ﺞ';
		$result = Multibyte::strrchr($string, $find);
		$expected = 'ﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$this->assertEqual($result, $expected);

		$string = 'ﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$find = 'ﺞ';
		$result = Multibyte::strrchr($string, $find, true);
		$expected = 'ﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝ';
		$this->assertEqual($result, $expected);

		$string = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻕﻖﻗﻘﻙﻚﻛﻜﻝﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻸﻹﻺﻻﻼ';
		$find = 'ﻞ';
		$result = Multibyte::strrchr($string, $find);
		$expected = 'ﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻸﻹﻺﻻﻼ';
		$this->assertEqual($result, $expected);

		$string = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻕﻖﻗﻘﻙﻚﻛﻜﻝﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻸﻹﻺﻻﻼ';
		$find = 'ﻞ';
		$result = Multibyte::strrchr($string, $find, true);
		$expected = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻕﻖﻗﻘﻙﻚﻛﻜﻝ';
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'ｋ';
		$result = Multibyte::strrchr($string, $find);
		$expected = 'ｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'ｋ';
		$result = Multibyte::strrchr($string, $find, true);
		$expected = 'ａｂｃｄｅｆｇｈｉｊ';
		$this->assertEqual($result, $expected);

		$string = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰｱｲｳｴｵｶｷｸ';
		$find = 'ｱ';
		$result = Multibyte::strrchr($string, $find);
		$expected = 'ｱｲｳｴｵｶｷｸ';
		$this->assertEqual($result, $expected);

		$string = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰｱｲｳｴｵｶｷｸ';
		$find = 'ｱ';
		$result = Multibyte::strrchr($string, $find, true);
		$expected = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰ';
		$this->assertEqual($result, $expected);

		$string = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$find = 'ﾊ';
		$result = Multibyte::strrchr($string, $find);
		$expected = 'ﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$this->assertEqual($result, $expected);

		$string = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$find = 'ﾊ';
		$result = Multibyte::strrchr($string, $find, true);
		$expected = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉ';
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'ő';
		$result = Multibyte::strrchr($string, $find);
		$expected = 'őřļď!';
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'ő';
		$result = Multibyte::strrchr($string, $find, true);
		$expected = 'Ĥēĺļŏ, Ŵ';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'o';
		$result = Multibyte::strrchr($string, $find);
		$expected = 'orld!';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'o';
		$result = Multibyte::strrchr($string, $find, true);
		$expected = 'Hello, W';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'Wo';
		$result = Multibyte::strrchr($string, $find);
		$expected = 'World!';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'Wo';
		$result = Multibyte::strrchr($string, $find, true);
		$expected = 'Hello, ';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'll';
		$result = Multibyte::strrchr($string, $find);
		$expected = 'llo, World!';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'll';
		$result = Multibyte::strrchr($string, $find, true);
		$expected = 'He';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'rld';
		$result = Multibyte::strrchr($string, $find);
		$expected = 'rld!';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'rld';
		$result = Multibyte::strrchr($string, $find, true);
		$expected = 'Hello, Wo';
		$this->assertEqual($result, $expected);

		$string = 'čini';
		$find = 'n';
		$result = Multibyte::strrchr($string, $find);
		$expected = 'ni';
		$this->assertEqual($result, $expected);

		$string = 'čini';
		$find = 'n';
		$result = Multibyte::strrchr($string, $find, true);
		$expected = 'či';
		$this->assertEqual($result, $expected);

		$string = 'moći';
		$find = 'ć';
		$result = Multibyte::strrchr($string, $find);
		$expected = 'ći';
		$this->assertEqual($result, $expected);

		$string = 'moći';
		$find = 'ć';
		$result = Multibyte::strrchr($string, $find, true);
		$expected = 'mo';
		$this->assertEqual($result, $expected);

		$string = 'državni';
		$find = 'ž';
		$result = Multibyte::strrchr($string, $find);
		$expected = 'žavni';
		$this->assertEqual($result, $expected);

		$string = 'državni';
		$find = 'ž';
		$result = Multibyte::strrchr($string, $find, true);
		$expected = 'dr';
		$this->assertEqual($result, $expected);

		$string = '把百度设为首页';
		$find = '设';
		$result = Multibyte::strrchr($string, $find);
		$expected = '设为首页';
		$this->assertEqual($result, $expected);

		$string = '把百度设为首页';
		$find = '设';
		$result = Multibyte::strrchr($string, $find, true);
		$expected = '把百度';
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$find = '周';
		$result = Multibyte::strrchr($string, $find);
		$expected = '周永龍';
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$find = '周';
		$result = Multibyte::strrchr($string, $find, true);
		$expected = '一二三';
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$find = '周龍';
		$result = Multibyte::strrchr($string, $find, true);
		$expected = false;
		$this->assertEqual($result, $expected);
	}

	function testUsingMbStrrichr() {
		$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$find = 'F';
		$result = mb_strrichr($string, $find);
		$expected = 'FGHIJKLMNOPQRSTUVWXYZ0123456789';
		$this->assertEqual($result, $expected);

		$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$find = 'F';
		$result = mb_strrichr($string, $find, true);
		$expected = 'ABCDE';
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$find = 'Å';
		$result = mb_strrichr($string, $find);
		$expected = 'ÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$find = 'Å';
		$result = mb_strrichr($string, $find, true);
		$expected = 'ÀÁÂÃÄ';
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$find = 'Ċ';
		$result = mb_strrichr($string, $find);
		$expected = 'ĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$find = 'Ċ';
		$result = mb_strrichr($string, $find, true);
		$expected = 'ĀĂĄĆĈ';
		$this->assertEqual($result, $expected);

		$string = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$find = 'F';
		$result = mb_strrichr($string, $find);
		$expected = 'fghijklmnopqrstuvwxyz{|}~';
		$this->assertEqual($result, $expected);

		$string = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$find = 'F';
		$result = mb_strrichr($string, $find, true);
		$expected = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcde';
		$this->assertEqual($result, $expected);

		$string = '¡¢£¤¥¦§¨©ª«¬­®¯°±²³´µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$find = 'µ';
		$result = mb_strrichr($string, $find);
		$expected = 'µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$this->assertEqual($result, $expected);

		$string = '¡¢£¤¥¦§¨©ª«¬­®¯°±²³´µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$find = 'µ';
		$result = mb_strrichr($string, $find, true);
		$expected = '¡¢£¤¥¦§¨©ª«¬­®¯°±²³´';
		$this->assertEqual($result, $expected);

		$string = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬ';
		$find = 'Þ';
		$result = mb_strrichr($string, $find);
		$expected = 'þÿĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬ';
		$this->assertEqual($result, $expected);

		$string = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬ';
		$find = 'Þ';
		$result = mb_strrichr($string, $find, true);
		$expected = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüý';
		$this->assertEqual($result, $expected);

		$string = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃńŅņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$find = 'Ņ';
		$result = mb_strrichr($string, $find);
		$expected = 'ņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$this->assertEqual($result, $expected);

		$string = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃńŅņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$find = 'Ņ';
		$result = mb_strrichr($string, $find, true);
		$expected = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃńŅ';
		$this->assertEqual($result, $expected);

		$string = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$find = 'Ƹ';
		$result = mb_strrichr($string, $find);
		$expected = 'ƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$this->assertEqual($result, $expected);

		$find = 'Ƹ';
		$result = mb_strrichr($string, $find, true);
		$expected = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷƸ';
		$this->assertEqual($result, $expected);

		$string = 'əɚɛɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$find = 'ʀ';
		$result = mb_strrichr($string, $find);
		$expected = 'ʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$this->assertEqual($result, $expected);

		$string = 'əɚɛɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$find = 'ʀ';
		$result = mb_strrichr($string, $find, true);
		$expected = 'əɚɛɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿ';
		$this->assertEqual($result, $expected);

		$string = 'ЀЁЂЃЄЅІЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$find = 'Ї';
		$result = mb_strrichr($string, $find);
		$expected = 'ЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$this->assertEqual($result, $expected);

		$string = 'ЀЁЂЃЄЅІЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$find = 'Ї';
		$result = mb_strrichr($string, $find, true);
		$expected = 'ЀЁЂЃЄЅІ';
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$find = 'Р';
		$result = mb_strrichr($string, $find);
		$expected = 'рстуфхцчшщъыь';
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмноп';
		$find = 'Р';
		$result = mb_strrichr($string, $find, true);
		$expected = 'МНОП';
		$this->assertEqual($result, $expected);

		$string = 'فقكلمنهوىيًٌٍَُ';
		$find = 'ن';
		$result = mb_strrichr($string, $find);
		$expected = 'نهوىيًٌٍَُ';
		$this->assertEqual($result, $expected);

		$string = 'فقكلمنهوىيًٌٍَُ';
		$find = 'ن';
		$result = mb_strrichr($string, $find, true);
		$expected = 'فقكلم';
		$this->assertEqual($result, $expected);

		$string = '✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾✿❀❁❂❃❄❅❆❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$find = '✿';
		$result = mb_strrichr($string, $find);
		$expected = '✿❀❁❂❃❄❅❆❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$this->assertEqual($result, $expected);

		$string = '✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾✿❀❁❂❃❄❅❆❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$find = '✿';
		$result = mb_strrichr($string, $find, true);
		$expected = '✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾';
		$this->assertEqual($result, $expected);

		$string = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺊⺋⺌⺍⺎⺏⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$find = '⺐';
		$result = mb_strrichr($string, $find);
		$expected = '⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$this->assertEqual($result, $expected);

		$string = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺊⺋⺌⺍⺎⺏⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$find = '⺐';
		$result = mb_strrichr($string, $find, true);
		$expected = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺊⺋⺌⺍⺎⺏';
		$this->assertEqual($result, $expected);

		$string = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$find = '⽤';
		$result = mb_strrichr($string, $find);
		$expected = '⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$this->assertEqual($result, $expected);

		$string = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$find = '⽤';
		$result = mb_strrichr($string, $find, true);
		$expected = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣';
		$this->assertEqual($result, $expected);

		$string = '눡눢눣눤눥눦눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕뉖뉗뉘뉙뉚뉛뉜뉝뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$find = '눻';
		$result = mb_strrichr($string, $find);
		$expected = '눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕뉖뉗뉘뉙뉚뉛뉜뉝뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$this->assertEqual($result, $expected);

		$string = '눡눢눣눤눥눦눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕뉖뉗뉘뉙뉚뉛뉜뉝뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$find = '눻';
		$result = mb_strrichr($string, $find, true);
		$expected = '눡눢눣눤눥눦눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺';
		$this->assertEqual($result, $expected);

		$string = 'ﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$find = 'ﺞ';
		$result = mb_strrichr($string, $find);
		$expected = 'ﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$this->assertEqual($result, $expected);

		$string = 'ﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$find = 'ﺞ';
		$result = mb_strrichr($string, $find, true);
		$expected = 'ﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝ';
		$this->assertEqual($result, $expected);

		$string = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻕﻖﻗﻘﻙﻚﻛﻜﻝﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻸﻹﻺﻻﻼ';
		$find = 'ﻞ';
		$result = mb_strrichr($string, $find);
		$expected = 'ﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻸﻹﻺﻻﻼ';
		$this->assertEqual($result, $expected);

		$string = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻕﻖﻗﻘﻙﻚﻛﻜﻝﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻸﻹﻺﻻﻼ';
		$find = 'ﻞ';
		$result = mb_strrichr($string, $find, true);
		$expected = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻕﻖﻗﻘﻙﻚﻛﻜﻝ';
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'ｋ';
		$result = mb_strrichr($string, $find);
		$expected = 'ｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'ｋ';
		$result = mb_strrichr($string, $find, true);
		$expected = 'ａｂｃｄｅｆｇｈｉｊ';
		$this->assertEqual($result, $expected);

		$string = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰｱｲｳｴｵｶｷｸ';
		$find = 'ｱ';
		$result = mb_strrichr($string, $find);
		$expected = 'ｱｲｳｴｵｶｷｸ';
		$this->assertEqual($result, $expected);

		$string = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰｱｲｳｴｵｶｷｸ';
		$find = 'ｱ';
		$result = mb_strrichr($string, $find, true);
		$expected = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰ';
		$this->assertEqual($result, $expected);

		$string = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$find = 'ﾊ';
		$result = mb_strrichr($string, $find);
		$expected = 'ﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$this->assertEqual($result, $expected);

		$string = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$find = 'ﾊ';
		$result = mb_strrichr($string, $find, true);
		$expected = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉ';
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'ő';
		$result = mb_strrichr($string, $find);
		$expected = 'őřļď!';
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'ő';
		$result = mb_strrichr($string, $find, true);
		$expected = 'Ĥēĺļŏ, Ŵ';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'o';
		$result = mb_strrichr($string, $find);
		$expected = 'orld!';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'o';
		$result = mb_strrichr($string, $find, true);
		$expected = 'Hello, W';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'Wo';
		$result = mb_strrichr($string, $find);
		$expected = 'World!';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'Wo';
		$result = mb_strrichr($string, $find, true);
		$expected = 'Hello, ';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'll';
		$result = mb_strrichr($string, $find);
		$expected = 'llo, World!';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'll';
		$result = mb_strrichr($string, $find, true);
		$expected = 'He';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'rld';
		$result = mb_strrichr($string, $find);
		$expected = 'rld!';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'rld';
		$result = mb_strrichr($string, $find, true);
		$expected = 'Hello, Wo';
		$this->assertEqual($result, $expected);

		$string = 'čini';
		$find = 'n';
		$result = mb_strrichr($string, $find);
		$expected = 'ni';
		$this->assertEqual($result, $expected);

		$string = 'čini';
		$find = 'n';
		$result = mb_strrichr($string, $find, true);
		$expected = 'či';
		$this->assertEqual($result, $expected);

		$string = 'moći';
		$find = 'ć';
		$result = mb_strrichr($string, $find);
		$expected = 'ći';
		$this->assertEqual($result, $expected);

		$string = 'moći';
		$find = 'ć';
		$result = mb_strrichr($string, $find, true);
		$expected = 'mo';
		$this->assertEqual($result, $expected);

		$string = 'državni';
		$find = 'ž';
		$result = mb_strrichr($string, $find);
		$expected = 'žavni';
		$this->assertEqual($result, $expected);

		$string = 'državni';
		$find = 'ž';
		$result = mb_strrichr($string, $find, true);
		$expected = 'dr';
		$this->assertEqual($result, $expected);

		$string = '把百度设为首页';
		$find = '设';
		$result = mb_strrichr($string, $find);
		$expected = '设为首页';
		$this->assertEqual($result, $expected);

		$string = '把百度设为首页';
		$find = '设';
		$result = mb_strrichr($string, $find, true);
		$expected = '把百度';
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$find = '周';
		$result = mb_strrichr($string, $find);
		$expected = '周永龍';
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$find = '周';
		$result = mb_strrichr($string, $find, true);
		$expected = '一二三';
		$this->assertEqual($result, $expected);

		$string = '把百度设为首页';
		$find = '百设';
		$result = mb_strrichr($string, $find, true);
		$expected = false;
		$this->assertEqual($result, $expected);
	}

	function testMultibyteStrrichr() {
		$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$find = 'F';
		$result = Multibyte::strrichr($string, $find);
		$expected = 'FGHIJKLMNOPQRSTUVWXYZ0123456789';
		$this->assertEqual($result, $expected);

		$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$find = 'F';
		$result = Multibyte::strrichr($string, $find, true);
		$expected = 'ABCDE';
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$find = 'Å';
		$result = Multibyte::strrichr($string, $find);
		$expected = 'ÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$find = 'Å';
		$result = Multibyte::strrichr($string, $find, true);
		$expected = 'ÀÁÂÃÄ';
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$find = 'Ċ';
		$result = Multibyte::strrichr($string, $find);
		$expected = 'ĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$find = 'Ċ';
		$result = Multibyte::strrichr($string, $find, true);
		$expected = 'ĀĂĄĆĈ';
		$this->assertEqual($result, $expected);

		$string = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$find = 'F';
		$result = Multibyte::strrichr($string, $find);
		$expected = 'fghijklmnopqrstuvwxyz{|}~';
		$this->assertEqual($result, $expected);

		$string = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$find = 'F';
		$result = Multibyte::strrichr($string, $find, true);
		$expected = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcde';
		$this->assertEqual($result, $expected);

		$string = '¡¢£¤¥¦§¨©ª«¬­®¯°±²³´µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$find = 'µ';
		$result = Multibyte::strrichr($string, $find);
		$expected = 'µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$this->assertEqual($result, $expected);

		$string = '¡¢£¤¥¦§¨©ª«¬­®¯°±²³´µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$find = 'µ';
		$result = Multibyte::strrichr($string, $find, true);
		$expected = '¡¢£¤¥¦§¨©ª«¬­®¯°±²³´';
		$this->assertEqual($result, $expected);

		$string = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬ';
		$find = 'Þ';
		$result = Multibyte::strrichr($string, $find);
		$expected = 'þÿĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬ';
		$this->assertEqual($result, $expected);

		$string = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬ';
		$find = 'Þ';
		$result = Multibyte::strrichr($string, $find, true);
		$expected = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüý';
		$this->assertEqual($result, $expected);

		$string = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃńŅņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$find = 'Ņ';
		$result = Multibyte::strrichr($string, $find);
		$expected = 'ņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$this->assertEqual($result, $expected);

		$string = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃńŅņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$find = 'Ņ';
		$result = Multibyte::strrichr($string, $find, true);
		$expected = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃńŅ';
		$this->assertEqual($result, $expected);

		$string = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$find = 'Ƹ';
		$result = Multibyte::strrichr($string, $find);
		$expected = 'ƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$this->assertEqual($result, $expected);

		$find = 'Ƹ';
		$result = Multibyte::strrichr($string, $find, true);
		$expected = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷƸ';
		$this->assertEqual($result, $expected);

		$string = 'əɚɛɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$find = 'ʀ';
		$result = Multibyte::strrichr($string, $find);
		$expected = 'ʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$this->assertEqual($result, $expected);

		$string = 'əɚɛɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$find = 'ʀ';
		$result = Multibyte::strrichr($string, $find, true);
		$expected = 'əɚɛɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿ';
		$this->assertEqual($result, $expected);

		$string = 'ЀЁЂЃЄЅІЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$find = 'Ї';
		$result = Multibyte::strrichr($string, $find);
		$expected = 'ЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$this->assertEqual($result, $expected);

		$string = 'ЀЁЂЃЄЅІЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$find = 'Ї';
		$result = Multibyte::strrichr($string, $find, true);
		$expected = 'ЀЁЂЃЄЅІ';
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$find = 'Р';
		$result = Multibyte::strrichr($string, $find);
		$expected = 'рстуфхцчшщъыь';
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмноп';
		$find = 'Р';
		$result = Multibyte::strrichr($string, $find, true);
		$expected = 'МНОП';
		$this->assertEqual($result, $expected);

		$string = 'فقكلمنهوىيًٌٍَُ';
		$find = 'ن';
		$result = Multibyte::strrichr($string, $find);
		$expected = 'نهوىيًٌٍَُ';
		$this->assertEqual($result, $expected);

		$string = 'فقكلمنهوىيًٌٍَُ';
		$find = 'ن';
		$result = Multibyte::strrichr($string, $find, true);
		$expected = 'فقكلم';
		$this->assertEqual($result, $expected);

		$string = '✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾✿❀❁❂❃❄❅❆❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$find = '✿';
		$result = Multibyte::strrichr($string, $find);
		$expected = '✿❀❁❂❃❄❅❆❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$this->assertEqual($result, $expected);

		$string = '✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾✿❀❁❂❃❄❅❆❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$find = '✿';
		$result = Multibyte::strrichr($string, $find, true);
		$expected = '✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾';
		$this->assertEqual($result, $expected);

		$string = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺊⺋⺌⺍⺎⺏⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$find = '⺐';
		$result = Multibyte::strrichr($string, $find);
		$expected = '⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$this->assertEqual($result, $expected);

		$string = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺊⺋⺌⺍⺎⺏⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$find = '⺐';
		$result = Multibyte::strrichr($string, $find, true);
		$expected = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺊⺋⺌⺍⺎⺏';
		$this->assertEqual($result, $expected);

		$string = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$find = '⽤';
		$result = Multibyte::strrichr($string, $find);
		$expected = '⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$this->assertEqual($result, $expected);

		$string = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$find = '⽤';
		$result = Multibyte::strrichr($string, $find, true);
		$expected = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣';
		$this->assertEqual($result, $expected);

		$string = '눡눢눣눤눥눦눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕뉖뉗뉘뉙뉚뉛뉜뉝뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$find = '눻';
		$result = Multibyte::strrichr($string, $find);
		$expected = '눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕뉖뉗뉘뉙뉚뉛뉜뉝뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$this->assertEqual($result, $expected);

		$string = '눡눢눣눤눥눦눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕뉖뉗뉘뉙뉚뉛뉜뉝뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$find = '눻';
		$result = Multibyte::strrichr($string, $find, true);
		$expected = '눡눢눣눤눥눦눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺';
		$this->assertEqual($result, $expected);

		$string = 'ﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$find = 'ﺞ';
		$result = Multibyte::strrichr($string, $find);
		$expected = 'ﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$this->assertEqual($result, $expected);

		$string = 'ﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$find = 'ﺞ';
		$result = Multibyte::strrichr($string, $find, true);
		$expected = 'ﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝ';
		$this->assertEqual($result, $expected);

		$string = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻕﻖﻗﻘﻙﻚﻛﻜﻝﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻸﻹﻺﻻﻼ';
		$find = 'ﻞ';
		$result = Multibyte::strrichr($string, $find);
		$expected = 'ﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻸﻹﻺﻻﻼ';
		$this->assertEqual($result, $expected);

		$string = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻕﻖﻗﻘﻙﻚﻛﻜﻝﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻸﻹﻺﻻﻼ';
		$find = 'ﻞ';
		$result = Multibyte::strrichr($string, $find, true);
		$expected = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻕﻖﻗﻘﻙﻚﻛﻜﻝ';
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'ｋ';
		$result = Multibyte::strrichr($string, $find);
		$expected = 'ｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'ｋ';
		$result = Multibyte::strrichr($string, $find, true);
		$expected = 'ａｂｃｄｅｆｇｈｉｊ';
		$this->assertEqual($result, $expected);

		$string = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰｱｲｳｴｵｶｷｸ';
		$find = 'ｱ';
		$result = Multibyte::strrichr($string, $find);
		$expected = 'ｱｲｳｴｵｶｷｸ';
		$this->assertEqual($result, $expected);

		$string = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰｱｲｳｴｵｶｷｸ';
		$find = 'ｱ';
		$result = Multibyte::strrichr($string, $find, true);
		$expected = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰ';
		$this->assertEqual($result, $expected);

		$string = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$find = 'ﾊ';
		$result = Multibyte::strrichr($string, $find);
		$expected = 'ﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$this->assertEqual($result, $expected);

		$string = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$find = 'ﾊ';
		$result = Multibyte::strrichr($string, $find, true);
		$expected = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉ';
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'ő';
		$result = Multibyte::strrichr($string, $find);
		$expected = 'őřļď!';
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'ő';
		$result = Multibyte::strrichr($string, $find, true);
		$expected = 'Ĥēĺļŏ, Ŵ';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'o';
		$result = Multibyte::strrichr($string, $find);
		$expected = 'orld!';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'o';
		$result = Multibyte::strrichr($string, $find, true);
		$expected = 'Hello, W';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'Wo';
		$result = Multibyte::strrichr($string, $find);
		$expected = 'World!';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'Wo';
		$result = Multibyte::strrichr($string, $find, true);
		$expected = 'Hello, ';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'll';
		$result = Multibyte::strrichr($string, $find);
		$expected = 'llo, World!';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'll';
		$result = Multibyte::strrichr($string, $find, true);
		$expected = 'He';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'rld';
		$result = Multibyte::strrichr($string, $find);
		$expected = 'rld!';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'rld';
		$result = Multibyte::strrichr($string, $find, true);
		$expected = 'Hello, Wo';
		$this->assertEqual($result, $expected);

		$string = 'čini';
		$find = 'n';
		$result = Multibyte::strrichr($string, $find);
		$expected = 'ni';
		$this->assertEqual($result, $expected);

		$string = 'čini';
		$find = 'n';
		$result = Multibyte::strrichr($string, $find, true);
		$expected = 'či';
		$this->assertEqual($result, $expected);

		$string = 'moći';
		$find = 'ć';
		$result = Multibyte::strrichr($string, $find);
		$expected = 'ći';
		$this->assertEqual($result, $expected);

		$string = 'moći';
		$find = 'ć';
		$result = Multibyte::strrichr($string, $find, true);
		$expected = 'mo';
		$this->assertEqual($result, $expected);

		$string = 'državni';
		$find = 'ž';
		$result = Multibyte::strrichr($string, $find);
		$expected = 'žavni';
		$this->assertEqual($result, $expected);

		$string = 'državni';
		$find = 'ž';
		$result = Multibyte::strrichr($string, $find, true);
		$expected = 'dr';
		$this->assertEqual($result, $expected);

		$string = '把百度设为首页';
		$find = '设';
		$result = Multibyte::strrichr($string, $find);
		$expected = '设为首页';
		$this->assertEqual($result, $expected);

		$string = '把百度设为首页';
		$find = '设';
		$result = Multibyte::strrichr($string, $find, true);
		$expected = '把百度';
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$find = '周';
		$result = Multibyte::strrichr($string, $find);
		$expected = '周永龍';
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$find = '周';
		$result = Multibyte::strrichr($string, $find, true);
		$expected = '一二三';
		$this->assertEqual($result, $expected);

		$string = '把百度设为首页';
		$find = '百设';
		$result = Multibyte::strrichr($string, $find, true);
		$expected = false;
		$this->assertEqual($result, $expected);
	}

	function testUsingMbStrripos() {
		$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$find = 'F';
		$result = mb_strripos($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'ABCDEFGHIJKLMNOPQFRSTUVWXYZ0123456789';
		$find = 'F';
		$result = mb_strripos($string, $find, 6);
		$expected = 17;
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$find = 'Å';
		$result = mb_strripos($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÅÙÚÛÜÝÞ';
		$find = 'Å';
		$result = mb_strripos($string, $find, 6);
		$expected = 24;
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÅÙÚÛÜÝÞ';
		$find = 'ÓÔ';
		$result = mb_strripos($string, $find);
		$expected = 19;
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$find = 'Ċ';
		$result = mb_strripos($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁĊŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$find = 'Ċ';
		$result = mb_strripos($string, $find, 6);
		$expected = 32;
		$this->assertEqual($result, $expected);

		$string = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$find = 'F';
		$result = mb_strripos($string, $find);
		$expected = 69;
		$this->assertEqual($result, $expected);

		$string = '¡¢£¤¥¦§¨©ª«¬­®¯°±²³´µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$find = 'µ';
		$result = mb_strripos($string, $find);
		$expected = 20;
		$this->assertEqual($result, $expected);

		$string = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬ';
		$find = 'é';
		$result = mb_strripos($string, $find);
		$expected = 32;
		$this->assertEqual($result, $expected);

		$string = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃńŅņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$find = 'Ņ';
		$result = mb_strripos($string, $find);
		$expected = 25;
		$this->assertEqual($result, $expected);

		$string = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$find = 'Ƹ';
		$result = mb_strripos($string, $find);
		$expected = 40;
		$this->assertEqual($result, $expected);

		$string = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$find = 'ƹ';
		$result = mb_strripos($string, $find);
		$expected = 40;
		$this->assertEqual($result, $expected);

		$string = 'əɚɛɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$find = 'ʀ';
		$result = mb_strripos($string, $find);
		$expected = 39;
		$this->assertEqual($result, $expected);

		$string = 'ЀЁЂЃЄЅІЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$find = 'Ї';
		$result = mb_strripos($string, $find);
		$expected = 7;
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$find = 'Р';
		$result = mb_strripos($string, $find);
		$expected = 36;
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$find = 'р';
		$result = mb_strripos($string, $find, 5);
		$expected = 36;
		$this->assertEqual($result, $expected);

		$string = 'فقكلمنهوىيًٌٍَُ';
		$find = 'ن';
		$result = mb_strripos($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = '✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾✿❀❁❂❃❄❅❆❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$find = '✿';
		$result = mb_strripos($string, $find);
		$expected = 15;
		$this->assertEqual($result, $expected);

		$string = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺊⺋⺌⺍⺎⺏⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$find = '⺐';
		$result = mb_strripos($string, $find);
		$expected = 16;
		$this->assertEqual($result, $expected);

		$string = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$find = '⽤';
		$result = mb_strripos($string, $find);
		$expected = 31;
		$this->assertEqual($result, $expected);

		$string = '눡눢눣눤눥눦눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕뉖뉗뉘뉙뉚뉛뉜뉝뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$find = '눻';
		$result = mb_strripos($string, $find);
		$expected = 26;
		$this->assertEqual($result, $expected);

		$string = 'ﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$find = 'ﺞ';
		$result = mb_strripos($string, $find);
		$expected = 46;
		$this->assertEqual($result, $expected);

		$string = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻕﻖﻗﻘﻙﻚﻛﻜﻝﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻸﻹﻺﻻﻼ';
		$find = 'ﻞ';
		$result = mb_strripos($string, $find);
		$expected = 45;
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'ｋ';
		$result = mb_strripos($string, $find);
		$expected = 10;
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'ｋ';
		$result = mb_strripos($string, $find);
		$expected = 10;
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'ｐｐ';
		$result = mb_strripos($string, $find);
		$expected = 15;
		$this->assertEqual($result, $expected);

		$string = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰｱｲｳｴｵｶｷｸ';
		$find = 'ｱ';
		$result = mb_strripos($string, $find);
		$expected = 16;
		$this->assertEqual($result, $expected);

		$string = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$find = 'ﾊ';
		$result = mb_strripos($string, $find);
		$expected = 17;
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'ő';
		$result = mb_strripos($string, $find);
		$expected = 8;
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'ő';
		$result = mb_strripos($string, $find);
		$expected = 8;
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'o';
		$result = mb_strripos($string, $find);
		$expected = 8;
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'o';
		$result = mb_strripos($string, $find, 5);
		$expected = 8;
		$this->assertEqual($result, $expected);

		$string = 'čini';
		$find = 'n';
		$result = mb_strripos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = 'čini';
		$find = 'n';
		$result = mb_strripos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = 'moći';
		$find = 'ć';
		$result = mb_strripos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = 'moći';
		$find = 'ć';
		$result = mb_strripos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = 'državni';
		$find = 'ž';
		$result = mb_strripos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = '把百度设为首页';
		$find = '设';
		$result = mb_strripos($string, $find);
		$expected = 3;
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$find = '周';
		$result = mb_strripos($string, $find);
		$expected = 3;
		$this->assertEqual($result, $expected);

		$string = 'državni';
		$find = 'dž';
		$result = mb_strripos($string, $find);
		$expected = false;
		$this->assertEqual($result, $expected);
	}

	function testMultibyteStrripos() {
		$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$find = 'F';
		$result = Multibyte::strripos($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'ABCDEFGHIJKLMNOPQFRSTUVWXYZ0123456789';
		$find = 'F';
		$result = Multibyte::strripos($string, $find, 6);
		$expected = 17;
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$find = 'Å';
		$result = Multibyte::strripos($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÅÙÚÛÜÝÞ';
		$find = 'Å';
		$result = Multibyte::strripos($string, $find, 6);
		$expected = 24;
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÅÙÚÛÜÝÞ';
		$find = 'ÓÔ';
		$result = Multibyte::strripos($string, $find);
		$expected = 19;
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$find = 'Ċ';
		$result = Multibyte::strripos($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁĊŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$find = 'Ċ';
		$result = Multibyte::strripos($string, $find, 6);
		$expected = 32;
		$this->assertEqual($result, $expected);

		$string = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$find = 'F';
		$result = Multibyte::strripos($string, $find);
		$expected = 69;
		$this->assertEqual($result, $expected);

		$string = '¡¢£¤¥¦§¨©ª«¬­®¯°±²³´µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$find = 'µ';
		$result = Multibyte::strripos($string, $find);
		$expected = 20;
		$this->assertEqual($result, $expected);

		$string = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬ';
		$find = 'é';
		$result = Multibyte::strripos($string, $find);
		$expected = 32;
		$this->assertEqual($result, $expected);

		$string = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃńŅņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$find = 'Ņ';
		$result = Multibyte::strripos($string, $find);
		$expected = 25;
		$this->assertEqual($result, $expected);

		$string = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$find = 'Ƹ';
		$result = Multibyte::strripos($string, $find);
		$expected = 40;
		$this->assertEqual($result, $expected);

		$string = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$find = 'ƹ';
		$result = Multibyte::strripos($string, $find);
		$expected = 40;
		$this->assertEqual($result, $expected);

		$string = 'əɚɛɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$find = 'ʀ';
		$result = Multibyte::strripos($string, $find);
		$expected = 39;
		$this->assertEqual($result, $expected);

		$string = 'ЀЁЂЃЄЅІЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$find = 'Ї';
		$result = Multibyte::strripos($string, $find);
		$expected = 7;
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$find = 'Р';
		$result = Multibyte::strripos($string, $find);
		$expected = 36;
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$find = 'р';
		$result = Multibyte::strripos($string, $find, 5);
		$expected = 36;
		$this->assertEqual($result, $expected);

		$string = 'فقكلمنهوىيًٌٍَُ';
		$find = 'ن';
		$result = Multibyte::strripos($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = '✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾✿❀❁❂❃❄❅❆❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$find = '✿';
		$result = Multibyte::strripos($string, $find);
		$expected = 15;
		$this->assertEqual($result, $expected);

		$string = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺊⺋⺌⺍⺎⺏⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$find = '⺐';
		$result = Multibyte::strripos($string, $find);
		$expected = 16;
		$this->assertEqual($result, $expected);

		$string = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$find = '⽤';
		$result = Multibyte::strripos($string, $find);
		$expected = 31;
		$this->assertEqual($result, $expected);

		$string = '눡눢눣눤눥눦눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕뉖뉗뉘뉙뉚뉛뉜뉝뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$find = '눻';
		$result = Multibyte::strripos($string, $find);
		$expected = 26;
		$this->assertEqual($result, $expected);

		$string = 'ﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$find = 'ﺞ';
		$result = Multibyte::strripos($string, $find);
		$expected = 46;
		$this->assertEqual($result, $expected);

		$string = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻕﻖﻗﻘﻙﻚﻛﻜﻝﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻸﻹﻺﻻﻼ';
		$find = 'ﻞ';
		$result = Multibyte::strripos($string, $find);
		$expected = 45;
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'ｋ';
		$result = Multibyte::strripos($string, $find);
		$expected = 10;
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'ｋ';
		$result = Multibyte::strripos($string, $find);
		$expected = 10;
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'ｐｐ';
		$result = Multibyte::strripos($string, $find);
		$expected = 15;
		$this->assertEqual($result, $expected);

		$string = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰｱｲｳｴｵｶｷｸ';
		$find = 'ｱ';
		$result = Multibyte::strripos($string, $find);
		$expected = 16;
		$this->assertEqual($result, $expected);

		$string = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$find = 'ﾊ';
		$result = Multibyte::strripos($string, $find);
		$expected = 17;
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'ő';
		$result = Multibyte::strripos($string, $find);
		$expected = 8;
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'ő';
		$result = Multibyte::strripos($string, $find);
		$expected = 8;
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'o';
		$result = Multibyte::strripos($string, $find);
		$expected = 8;
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'o';
		$result = Multibyte::strripos($string, $find, 5);
		$expected = 8;
		$this->assertEqual($result, $expected);

		$string = 'čini';
		$find = 'n';
		$result = Multibyte::strripos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = 'čini';
		$find = 'n';
		$result = Multibyte::strripos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = 'moći';
		$find = 'ć';
		$result = Multibyte::strripos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = 'moći';
		$find = 'ć';
		$result = Multibyte::strripos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = 'državni';
		$find = 'ž';
		$result = Multibyte::strripos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = '把百度设为首页';
		$find = '设';
		$result = Multibyte::strripos($string, $find);
		$expected = 3;
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$find = '周';
		$result = Multibyte::strripos($string, $find);
		$expected = 3;
		$this->assertEqual($result, $expected);

		$string = 'državni';
		$find = 'dž';
		$result = Multibyte::strripos($string, $find);
		$expected = false;
		$this->assertEqual($result, $expected);
	}

	function testUsingMbStrrpos() {
		$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$find = 'F';
		$result = mb_strrpos($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'ABCDEFGHIJKLMNOPQFRSTUVWXYZ0123456789';
		$find = 'F';
		$result = mb_strrpos($string, $find, 6);
		$expected = 17;
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$find = 'Å';
		$result = mb_strrpos($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÅÙÚÛÜÝÞ';
		$find = 'ÙÚ';
		$result = mb_strrpos($string, $find);
		$expected = 25;
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÅÙÚÛÜÝÞ';
		$find = 'Å';
		$result = mb_strrpos($string, $find, 6);
		$expected = 24;
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$find = 'Ċ';
		$result = mb_strrpos($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁĊŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$find = 'Ċ';
		$result = mb_strrpos($string, $find, 6);
		$expected = 32;
		$this->assertEqual($result, $expected);

		$string = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$find = 'F';
		$result = mb_strrpos($string, $find);
		$expected = 37;
		$this->assertEqual($result, $expected);

		$string = '¡¢£¤¥¦§¨©ª«¬­®¯°±²³´µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$find = 'µ';
		$result = mb_strrpos($string, $find);
		$expected = 20;
		$this->assertEqual($result, $expected);

		$string = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬ';
		$find = 'é';
		$result = mb_strrpos($string, $find);
		$expected = 32;
		$this->assertEqual($result, $expected);

		$string = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃńŅņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$find = 'Ņ';
		$result = mb_strrpos($string, $find);
		$expected = 24;
		$this->assertEqual($result, $expected);

		$string = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$find = 'Ƹ';
		$result = mb_strrpos($string, $find);
		$expected = 39;
		$this->assertEqual($result, $expected);

		$string = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$find = 'ƹ';
		$result = mb_strrpos($string, $find);
		$expected = 40;
		$this->assertEqual($result, $expected);

		$string = 'əɚɛɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$find = 'ʀ';
		$result = mb_strrpos($string, $find);
		$expected = 39;
		$this->assertEqual($result, $expected);

		$string = 'ЀЁЂЃЄЅІЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$find = 'Ї';
		$result = mb_strrpos($string, $find);
		$expected = 7;
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$find = 'Р';
		$result = mb_strrpos($string, $find);
		$expected = 4;
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$find = 'р';
		$result = mb_strrpos($string, $find, 5);
		$expected = 36;
		$this->assertEqual($result, $expected);

		$string = 'فقكلمنهوىيًٌٍَُ';
		$find = 'ن';
		$result = mb_strrpos($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = '✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾✿❀❁❂❃❄❅❆❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$find = '✿';
		$result = mb_strrpos($string, $find);
		$expected = 15;
		$this->assertEqual($result, $expected);

		$string = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺊⺋⺌⺍⺎⺏⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$find = '⺐';
		$result = mb_strrpos($string, $find);
		$expected = 16;
		$this->assertEqual($result, $expected);

		$string = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$find = '⽤';
		$result = mb_strrpos($string, $find);
		$expected = 31;
		$this->assertEqual($result, $expected);

		$string = '눡눢눣눤눥눦눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕뉖뉗뉘뉙뉚뉛뉜뉝뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$find = '눻';
		$result = mb_strrpos($string, $find);
		$expected = 26;
		$this->assertEqual($result, $expected);

		$string = 'ﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$find = 'ﺞ';
		$result = mb_strrpos($string, $find);
		$expected = 46;
		$this->assertEqual($result, $expected);

		$string = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻕﻖﻗﻘﻙﻚﻛﻜﻝﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻸﻹﻺﻻﻼ';
		$find = 'ﻞ';
		$result = mb_strrpos($string, $find);
		$expected = 45;
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'ｋ';
		$result = mb_strrpos($string, $find);
		$expected = 10;
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'ｋ';
		$result = mb_strrpos($string, $find);
		$expected = 10;
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'ｐｐ';
		$result = mb_strrpos($string, $find);
		$expected = 15;
		$this->assertEqual($result, $expected);

		$string = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰｱｲｳｴｵｶｷｸ';
		$find = 'ｱ';
		$result = mb_strrpos($string, $find);
		$expected = 16;
		$this->assertEqual($result, $expected);

		$string = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$find = 'ﾊ';
		$result = mb_strrpos($string, $find);
		$expected = 17;
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'ő';
		$result = mb_strrpos($string, $find);
		$expected = 8;
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'ő';
		$result = mb_strrpos($string, $find);
		$expected = 8;
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'o';
		$result = mb_strrpos($string, $find);
		$expected = 8;
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'o';
		$result = mb_strrpos($string, $find, 5);
		$expected = 8;
		$this->assertEqual($result, $expected);

		$string = 'čini';
		$find = 'n';
		$result = mb_strrpos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = 'čini';
		$find = 'n';
		$result = mb_strrpos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = 'moći';
		$find = 'ć';
		$result = mb_strrpos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = 'moći';
		$find = 'ć';
		$result = mb_strrpos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = 'državni';
		$find = 'ž';
		$result = mb_strrpos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = '把百度设为首页';
		$find = '设';
		$result = mb_strrpos($string, $find);
		$expected = 3;
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$find = '周';
		$result = mb_strrpos($string, $find);
		$expected = 3;
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'H';
		$result = mb_strrpos($string, $find);
		$expected = false;
		$this->assertEqual($result, $expected);
	}

	function testMultibyteStrrpos() {
		$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$find = 'F';
		$result = Multibyte::strrpos($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'ABCDEFGHIJKLMNOPQFRSTUVWXYZ0123456789';
		$find = 'F';
		$result = Multibyte::strrpos($string, $find, 6);
		$expected = 17;
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$find = 'Å';
		$result = Multibyte::strrpos($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÅÙÚÛÜÝÞ';
		$find = 'Å';
		$result = Multibyte::strrpos($string, $find, 6);
		$expected = 24;
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÅÙÚÛÜÝÞ';
		$find = 'ÙÚ';
		$result = Multibyte::strrpos($string, $find);
		$expected = 25;
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$find = 'Ċ';
		$result = Multibyte::strrpos($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁĊŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$find = 'Ċ';
		$result = Multibyte::strrpos($string, $find, 6);
		$expected = 32;
		$this->assertEqual($result, $expected);

		$string = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$find = 'F';
		$result = Multibyte::strrpos($string, $find);
		$expected = 37;
		$this->assertEqual($result, $expected);

		$string = '¡¢£¤¥¦§¨©ª«¬­®¯°±²³´µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$find = 'µ';
		$result = Multibyte::strrpos($string, $find);
		$expected = 20;
		$this->assertEqual($result, $expected);

		$string = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬ';
		$find = 'é';
		$result = Multibyte::strrpos($string, $find);
		$expected = 32;
		$this->assertEqual($result, $expected);

		$string = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃńŅņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$find = 'Ņ';
		$result = Multibyte::strrpos($string, $find);
		$expected = 24;
		$this->assertEqual($result, $expected);

		$string = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$find = 'Ƹ';
		$result = Multibyte::strrpos($string, $find);
		$expected = 39;
		$this->assertEqual($result, $expected);

		$string = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$find = 'ƹ';
		$result = Multibyte::strrpos($string, $find);
		$expected = 40;
		$this->assertEqual($result, $expected);

		$string = 'əɚɛɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$find = 'ʀ';
		$result = Multibyte::strrpos($string, $find);
		$expected = 39;
		$this->assertEqual($result, $expected);

		$string = 'ЀЁЂЃЄЅІЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$find = 'Ї';
		$result = Multibyte::strrpos($string, $find);
		$expected = 7;
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$find = 'Р';
		$result = Multibyte::strrpos($string, $find);
		$expected = 4;
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$find = 'р';
		$result = Multibyte::strrpos($string, $find, 5);
		$expected = 36;
		$this->assertEqual($result, $expected);

		$string = 'فقكلمنهوىيًٌٍَُ';
		$find = 'ن';
		$result = Multibyte::strrpos($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = '✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾✿❀❁❂❃❄❅❆❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$find = '✿';
		$result = Multibyte::strrpos($string, $find);
		$expected = 15;
		$this->assertEqual($result, $expected);

		$string = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺊⺋⺌⺍⺎⺏⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$find = '⺐';
		$result = Multibyte::strrpos($string, $find);
		$expected = 16;
		$this->assertEqual($result, $expected);

		$string = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$find = '⽤';
		$result = Multibyte::strrpos($string, $find);
		$expected = 31;
		$this->assertEqual($result, $expected);

		$string = '눡눢눣눤눥눦눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕뉖뉗뉘뉙뉚뉛뉜뉝뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$find = '눻';
		$result = Multibyte::strrpos($string, $find);
		$expected = 26;
		$this->assertEqual($result, $expected);

		$string = 'ﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$find = 'ﺞ';
		$result = Multibyte::strrpos($string, $find);
		$expected = 46;
		$this->assertEqual($result, $expected);

		$string = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻕﻖﻗﻘﻙﻚﻛﻜﻝﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻸﻹﻺﻻﻼ';
		$find = 'ﻞ';
		$result = Multibyte::strrpos($string, $find);
		$expected = 45;
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'ｋ';
		$result = Multibyte::strrpos($string, $find);
		$expected = 10;
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'ｋ';
		$result = Multibyte::strrpos($string, $find);
		$expected = 10;
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'ｐｐ';
		$result = Multibyte::strrpos($string, $find);
		$expected = 15;
		$this->assertEqual($result, $expected);

		$string = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰｱｲｳｴｵｶｷｸ';
		$find = 'ｱ';
		$result = Multibyte::strrpos($string, $find);
		$expected = 16;
		$this->assertEqual($result, $expected);

		$string = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$find = 'ﾊ';
		$result = Multibyte::strrpos($string, $find);
		$expected = 17;
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'ő';
		$result = Multibyte::strrpos($string, $find);
		$expected = 8;
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'ő';
		$result = Multibyte::strrpos($string, $find);
		$expected = 8;
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'o';
		$result = Multibyte::strrpos($string, $find);
		$expected = 8;
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'o';
		$result = Multibyte::strrpos($string, $find, 5);
		$expected = 8;
		$this->assertEqual($result, $expected);

		$string = 'čini';
		$find = 'n';
		$result = Multibyte::strrpos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = 'čini';
		$find = 'n';
		$result = Multibyte::strrpos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = 'moći';
		$find = 'ć';
		$result = Multibyte::strrpos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = 'moći';
		$find = 'ć';
		$result = Multibyte::strrpos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = 'državni';
		$find = 'ž';
		$result = Multibyte::strrpos($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = '把百度设为首页';
		$find = '设';
		$result = Multibyte::strrpos($string, $find);
		$expected = 3;
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$find = '周';
		$result = Multibyte::strrpos($string, $find);
		$expected = 3;
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'H';
		$result = Multibyte::strrpos($string, $find);
		$expected = false;
		$this->assertEqual($result, $expected);
	}

	function testUsingMbStrstr() {
		$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$find = 'F';
		$result = mb_strstr($string, $find);
		$expected = 'FGHIJKLMNOPQRSTUVWXYZ0123456789';
		$this->assertEqual($result, $expected);

		$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$find = 'F';
		$result = mb_strstr($string, $find, true);
		$expected = 'ABCDE';
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$find = 'Å';
		$result = mb_strstr($string, $find);
		$expected = 'ÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$find = 'Å';
		$result = mb_strstr($string, $find, true);
		$expected = 'ÀÁÂÃÄ';
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$find = 'Ċ';
		$result = mb_strstr($string, $find);
		$expected = 'ĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$find = 'Ċ';
		$result = mb_strstr($string, $find, true);
		$expected = 'ĀĂĄĆĈ';
		$this->assertEqual($result, $expected);

		$string = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$find = 'F';
		$result = mb_strstr($string, $find);
		$expected = 'FGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$this->assertEqual($result, $expected);

		$string = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$find = 'F';
		$result = mb_strstr($string, $find, true);
		$expected = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDE';
		$this->assertEqual($result, $expected);

		$string = '¡¢£¤¥¦§¨©ª«¬­®¯°±²³´µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$find = 'µ';
		$result = mb_strstr($string, $find);
		$expected = 'µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$this->assertEqual($result, $expected);

		$string = '¡¢£¤¥¦§¨©ª«¬­®¯°±²³´µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$find = 'µ';
		$result = mb_strstr($string, $find, true);
		$expected = '¡¢£¤¥¦§¨©ª«¬­®¯°±²³´';
		$this->assertEqual($result, $expected);

		$string = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬ';
		$find = 'Þ';
		$result = mb_strstr($string, $find);
		$expected = 'Þßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬ';
		$this->assertEqual($result, $expected);

		$string = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬ';
		$find = 'Þ';
		$result = mb_strstr($string, $find, true);
		$expected = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝ';
		$this->assertEqual($result, $expected);

		$string = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃńŅņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$find = 'Ņ';
		$result = mb_strstr($string, $find);
		$expected = 'ŅņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$this->assertEqual($result, $expected);

		$string = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃńŅņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$find = 'Ņ';
		$result = mb_strstr($string, $find, true);
		$expected = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃń';
		$this->assertEqual($result, $expected);

		$string = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$find = 'Ƹ';
		$result = mb_strstr($string, $find);
		$expected = 'ƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$this->assertEqual($result, $expected);

		$find = 'Ƹ';
		$result = mb_strstr($string, $find, true);
		$expected = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷ';
		$this->assertEqual($result, $expected);

		$string = 'əɚɛɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$find = 'ʀ';
		$result = mb_strstr($string, $find);
		$expected = 'ʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$this->assertEqual($result, $expected);

		$string = 'əɚɛɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$find = 'ʀ';
		$result = mb_strstr($string, $find, true);
		$expected = 'əɚɛɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿ';
		$this->assertEqual($result, $expected);

		$string = 'ЀЁЂЃЄЅІЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$find = 'Ї';
		$result = mb_strstr($string, $find);
		$expected = 'ЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$this->assertEqual($result, $expected);

		$string = 'ЀЁЂЃЄЅІЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$find = 'Ї';
		$result = mb_strstr($string, $find, true);
		$expected = 'ЀЁЂЃЄЅІ';
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$find = 'Р';
		$result = mb_strstr($string, $find);
		$expected = 'РСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$find = 'Р';
		$result = mb_strstr($string, $find, true);
		$expected = 'МНОП';
		$this->assertEqual($result, $expected);

		$string = 'فقكلمنهوىيًٌٍَُ';
		$find = 'ن';
		$result = mb_strstr($string, $find);
		$expected = 'نهوىيًٌٍَُ';
		$this->assertEqual($result, $expected);

		$string = 'فقكلمنهوىيًٌٍَُ';
		$find = 'ن';
		$result = mb_strstr($string, $find, true);
		$expected = 'فقكلم';
		$this->assertEqual($result, $expected);

		$string = '✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾✿❀❁❂❃❄❅❆❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$find = '✿';
		$result = mb_strstr($string, $find);
		$expected = '✿❀❁❂❃❄❅❆❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$this->assertEqual($result, $expected);

		$string = '✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾✿❀❁❂❃❄❅❆❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$find = '✿';
		$result = mb_strstr($string, $find, true);
		$expected = '✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾';
		$this->assertEqual($result, $expected);

		$string = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺊⺋⺌⺍⺎⺏⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$find = '⺐';
		$result = mb_strstr($string, $find);
		$expected = '⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$this->assertEqual($result, $expected);

		$string = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺊⺋⺌⺍⺎⺏⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$find = '⺐';
		$result = mb_strstr($string, $find, true);
		$expected = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺊⺋⺌⺍⺎⺏';
		$this->assertEqual($result, $expected);

		$string = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$find = '⽤';
		$result = mb_strstr($string, $find);
		$expected = '⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$this->assertEqual($result, $expected);

		$string = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$find = '⽤';
		$result = mb_strstr($string, $find, true);
		$expected = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣';
		$this->assertEqual($result, $expected);

		$string = '눡눢눣눤눥눦눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕뉖뉗뉘뉙뉚뉛뉜뉝뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$find = '눻';
		$result = mb_strstr($string, $find);
		$expected = '눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕뉖뉗뉘뉙뉚뉛뉜뉝뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$this->assertEqual($result, $expected);

		$string = '눡눢눣눤눥눦눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕뉖뉗뉘뉙뉚뉛뉜뉝뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$find = '눻';
		$result = mb_strstr($string, $find, true);
		$expected = '눡눢눣눤눥눦눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺';
		$this->assertEqual($result, $expected);

		$string = 'ﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$find = 'ﺞ';
		$result = mb_strstr($string, $find);
		$expected = 'ﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$this->assertEqual($result, $expected);

		$string = 'ﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$find = 'ﺞ';
		$result = mb_strstr($string, $find, true);
		$expected = 'ﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝ';
		$this->assertEqual($result, $expected);

		$string = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻕﻖﻗﻘﻙﻚﻛﻜﻝﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻸﻹﻺﻻﻼ';
		$find = 'ﻞ';
		$result = mb_strstr($string, $find);
		$expected = 'ﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻸﻹﻺﻻﻼ';
		$this->assertEqual($result, $expected);

		$string = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻕﻖﻗﻘﻙﻚﻛﻜﻝﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻸﻹﻺﻻﻼ';
		$find = 'ﻞ';
		$result = mb_strstr($string, $find, true);
		$expected = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻕﻖﻗﻘﻙﻚﻛﻜﻝ';
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'ｋ';
		$result = mb_strstr($string, $find);
		$expected = 'ｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'ｋ';
		$result = mb_strstr($string, $find, true);
		$expected = 'ａｂｃｄｅｆｇｈｉｊ';
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'Ｋ';
		$result = mb_strstr($string, $find);
		$expected = false;
		$this->assertEqual($result, $expected);

		$string = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰｱｲｳｴｵｶｷｸ';
		$find = 'ｱ';
		$result = mb_strstr($string, $find);
		$expected = 'ｱｲｳｴｵｶｷｸ';
		$this->assertEqual($result, $expected);

		$string = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰｱｲｳｴｵｶｷｸ';
		$find = 'ｱ';
		$result = mb_strstr($string, $find, true);
		$expected = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰ';
		$this->assertEqual($result, $expected);

		$string = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$find = 'ﾊ';
		$result = mb_strstr($string, $find);
		$expected = 'ﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$this->assertEqual($result, $expected);

		$string = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$find = 'ﾊ';
		$result = mb_strstr($string, $find, true);
		$expected = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉ';
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'ő';
		$result = mb_strstr($string, $find);
		$expected = 'őřļď!';
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'ő';
		$result = mb_strstr($string, $find, true);
		$expected = 'Ĥēĺļŏ, Ŵ';
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'ĺļ';
		$result = mb_strstr($string, $find, true);
		$expected = 'Ĥē';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'o';
		$result = mb_strstr($string, $find);
		$expected = 'o, World!';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'o';
		$result = mb_strstr($string, $find, true);
		$expected = 'Hell';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'Wo';
		$result = mb_strstr($string, $find);
		$expected = 'World!';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'Wo';
		$result = mb_strstr($string, $find, true);
		$expected = 'Hello, ';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'll';
		$result = mb_strstr($string, $find);
		$expected = 'llo, World!';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'll';
		$result = mb_strstr($string, $find, true);
		$expected = 'He';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'rld';
		$result = mb_strstr($string, $find);
		$expected = 'rld!';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'rld';
		$result = mb_strstr($string, $find, true);
		$expected = 'Hello, Wo';
		$this->assertEqual($result, $expected);

		$string = 'čini';
		$find = 'n';
		$result = mb_strstr($string, $find);
		$expected = 'ni';
		$this->assertEqual($result, $expected);

		$string = 'čini';
		$find = 'n';
		$result = mb_strstr($string, $find, true);
		$expected = 'či';
		$this->assertEqual($result, $expected);

		$string = 'moći';
		$find = 'ć';
		$result = mb_strstr($string, $find);
		$expected = 'ći';
		$this->assertEqual($result, $expected);

		$string = 'moći';
		$find = 'ć';
		$result = mb_strstr($string, $find, true);
		$expected = 'mo';
		$this->assertEqual($result, $expected);

		$string = 'državni';
		$find = 'ž';
		$result = mb_strstr($string, $find);
		$expected = 'žavni';
		$this->assertEqual($result, $expected);

		$string = 'državni';
		$find = 'ž';
		$result = mb_strstr($string, $find, true);
		$expected = 'dr';
		$this->assertEqual($result, $expected);

		$string = '把百度设为首页';
		$find = '设';
		$result = mb_strstr($string, $find);
		$expected = '设为首页';
		$this->assertEqual($result, $expected);

		$string = '把百度设为首页';
		$find = '设';
		$result = mb_strstr($string, $find, true);
		$expected = '把百度';
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$find = '周';
		$result = mb_strstr($string, $find);
		$expected = '周永龍';
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$find = '周';
		$result = mb_strstr($string, $find, true);
		$expected = '一二三';
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$find = '二周';
		$result = mb_strstr($string, $find);
		$expected = false;
		$this->assertEqual($result, $expected);
	}

	function testMultibyteStrstr() {
		$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$find = 'F';
		$result = Multibyte::strstr($string, $find);
		$expected = 'FGHIJKLMNOPQRSTUVWXYZ0123456789';
		$this->assertEqual($result, $expected);

		$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$find = 'F';
		$result = Multibyte::strstr($string, $find, true);
		$expected = 'ABCDE';
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$find = 'Å';
		$result = Multibyte::strstr($string, $find);
		$expected = 'ÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$find = 'Å';
		$result = Multibyte::strstr($string, $find, true);
		$expected = 'ÀÁÂÃÄ';
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$find = 'Ċ';
		$result = Multibyte::strstr($string, $find);
		$expected = 'ĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$find = 'Ċ';
		$result = Multibyte::strstr($string, $find, true);
		$expected = 'ĀĂĄĆĈ';
		$this->assertEqual($result, $expected);

		$string = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$find = 'F';
		$result = Multibyte::strstr($string, $find);
		$expected = 'FGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$this->assertEqual($result, $expected);

		$string = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$find = 'F';
		$result = Multibyte::strstr($string, $find, true);
		$expected = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDE';
		$this->assertEqual($result, $expected);

		$string = '¡¢£¤¥¦§¨©ª«¬­®¯°±²³´µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$find = 'µ';
		$result = Multibyte::strstr($string, $find);
		$expected = 'µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$this->assertEqual($result, $expected);

		$string = '¡¢£¤¥¦§¨©ª«¬­®¯°±²³´µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$find = 'µ';
		$result = Multibyte::strstr($string, $find, true);
		$expected = '¡¢£¤¥¦§¨©ª«¬­®¯°±²³´';
		$this->assertEqual($result, $expected);

		$string = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬ';
		$find = 'Þ';
		$result = Multibyte::strstr($string, $find);
		$expected = 'Þßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬ';
		$this->assertEqual($result, $expected);

		$string = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬ';
		$find = 'Þ';
		$result = Multibyte::strstr($string, $find, true);
		$expected = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝ';
		$this->assertEqual($result, $expected);

		$string = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃńŅņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$find = 'Ņ';
		$result = Multibyte::strstr($string, $find);
		$expected = 'ŅņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$this->assertEqual($result, $expected);

		$string = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃńŅņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$find = 'Ņ';
		$result = Multibyte::strstr($string, $find, true);
		$expected = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃń';
		$this->assertEqual($result, $expected);

		$string = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$find = 'Ƹ';
		$result = Multibyte::strstr($string, $find);
		$expected = 'ƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$this->assertEqual($result, $expected);

		$find = 'Ƹ';
		$result = Multibyte::strstr($string, $find, true);
		$expected = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷ';
		$this->assertEqual($result, $expected);

		$string = 'əɚɛɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$find = 'ʀ';
		$result = Multibyte::strstr($string, $find);
		$expected = 'ʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$this->assertEqual($result, $expected);

		$string = 'əɚɛɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$find = 'ʀ';
		$result = Multibyte::strstr($string, $find, true);
		$expected = 'əɚɛɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿ';
		$this->assertEqual($result, $expected);

		$string = 'ЀЁЂЃЄЅІЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$find = 'Ї';
		$result = Multibyte::strstr($string, $find);
		$expected = 'ЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$this->assertEqual($result, $expected);

		$string = 'ЀЁЂЃЄЅІЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$find = 'Ї';
		$result = Multibyte::strstr($string, $find, true);
		$expected = 'ЀЁЂЃЄЅІ';
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$find = 'Р';
		$result = Multibyte::strstr($string, $find);
		$expected = 'РСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$find = 'Р';
		$result = Multibyte::strstr($string, $find, true);
		$expected = 'МНОП';
		$this->assertEqual($result, $expected);

		$string = 'فقكلمنهوىيًٌٍَُ';
		$find = 'ن';
		$result = Multibyte::strstr($string, $find);
		$expected = 'نهوىيًٌٍَُ';
		$this->assertEqual($result, $expected);

		$string = 'فقكلمنهوىيًٌٍَُ';
		$find = 'ن';
		$result = Multibyte::strstr($string, $find, true);
		$expected = 'فقكلم';
		$this->assertEqual($result, $expected);

		$string = '✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾✿❀❁❂❃❄❅❆❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$find = '✿';
		$result = Multibyte::strstr($string, $find);
		$expected = '✿❀❁❂❃❄❅❆❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$this->assertEqual($result, $expected);

		$string = '✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾✿❀❁❂❃❄❅❆❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$find = '✿';
		$result = Multibyte::strstr($string, $find, true);
		$expected = '✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾';
		$this->assertEqual($result, $expected);

		$string = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺊⺋⺌⺍⺎⺏⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$find = '⺐';
		$result = Multibyte::strstr($string, $find);
		$expected = '⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$this->assertEqual($result, $expected);

		$string = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺊⺋⺌⺍⺎⺏⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$find = '⺐';
		$result = Multibyte::strstr($string, $find, true);
		$expected = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺊⺋⺌⺍⺎⺏';
		$this->assertEqual($result, $expected);

		$string = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$find = '⽤';
		$result = Multibyte::strstr($string, $find);
		$expected = '⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$this->assertEqual($result, $expected);

		$string = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$find = '⽤';
		$result = Multibyte::strstr($string, $find, true);
		$expected = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣';
		$this->assertEqual($result, $expected);

		$string = '눡눢눣눤눥눦눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕뉖뉗뉘뉙뉚뉛뉜뉝뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$find = '눻';
		$result = Multibyte::strstr($string, $find);
		$expected = '눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕뉖뉗뉘뉙뉚뉛뉜뉝뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$this->assertEqual($result, $expected);

		$string = '눡눢눣눤눥눦눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕뉖뉗뉘뉙뉚뉛뉜뉝뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$find = '눻';
		$result = Multibyte::strstr($string, $find, true);
		$expected = '눡눢눣눤눥눦눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺';
		$this->assertEqual($result, $expected);

		$string = 'ﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$find = 'ﺞ';
		$result = Multibyte::strstr($string, $find);
		$expected = 'ﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$this->assertEqual($result, $expected);

		$string = 'ﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$find = 'ﺞ';
		$result = Multibyte::strstr($string, $find, true);
		$expected = 'ﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝ';
		$this->assertEqual($result, $expected);

		$string = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻕﻖﻗﻘﻙﻚﻛﻜﻝﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻸﻹﻺﻻﻼ';
		$find = 'ﻞ';
		$result = Multibyte::strstr($string, $find);
		$expected = 'ﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻸﻹﻺﻻﻼ';
		$this->assertEqual($result, $expected);

		$string = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻕﻖﻗﻘﻙﻚﻛﻜﻝﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻸﻹﻺﻻﻼ';
		$find = 'ﻞ';
		$result = Multibyte::strstr($string, $find, true);
		$expected = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻕﻖﻗﻘﻙﻚﻛﻜﻝ';
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'ｋ';
		$result = Multibyte::strstr($string, $find);
		$expected = 'ｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'ｋ';
		$result = Multibyte::strstr($string, $find, true);
		$expected = 'ａｂｃｄｅｆｇｈｉｊ';
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'Ｋ';
		$result = Multibyte::strstr($string, $find);
		$expected = false;
		$this->assertEqual($result, $expected);

		$string = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰｱｲｳｴｵｶｷｸ';
		$find = 'ｱ';
		$result = Multibyte::strstr($string, $find);
		$expected = 'ｱｲｳｴｵｶｷｸ';
		$this->assertEqual($result, $expected);

		$string = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰｱｲｳｴｵｶｷｸ';
		$find = 'ｱ';
		$result = Multibyte::strstr($string, $find, true);
		$expected = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰ';
		$this->assertEqual($result, $expected);

		$string = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$find = 'ﾊ';
		$result = Multibyte::strstr($string, $find);
		$expected = 'ﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$this->assertEqual($result, $expected);

		$string = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$find = 'ﾊ';
		$result = Multibyte::strstr($string, $find, true);
		$expected = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉ';
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'ő';
		$result = Multibyte::strstr($string, $find);
		$expected = 'őřļď!';
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'ő';
		$result = Multibyte::strstr($string, $find, true);
		$expected = 'Ĥēĺļŏ, Ŵ';
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'ĺļ';
		$result = Multibyte::strstr($string, $find, true);
		$expected = 'Ĥē';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'o';
		$result = Multibyte::strstr($string, $find);
		$expected = 'o, World!';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'o';
		$result = Multibyte::strstr($string, $find, true);
		$expected = 'Hell';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'Wo';
		$result = Multibyte::strstr($string, $find);
		$expected = 'World!';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'Wo';
		$result = Multibyte::strstr($string, $find, true);
		$expected = 'Hello, ';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'll';
		$result = Multibyte::strstr($string, $find);
		$expected = 'llo, World!';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'll';
		$result = Multibyte::strstr($string, $find, true);
		$expected = 'He';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'rld';
		$result = Multibyte::strstr($string, $find);
		$expected = 'rld!';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'rld';
		$result = Multibyte::strstr($string, $find, true);
		$expected = 'Hello, Wo';
		$this->assertEqual($result, $expected);

		$string = 'čini';
		$find = 'n';
		$result = Multibyte::strstr($string, $find);
		$expected = 'ni';
		$this->assertEqual($result, $expected);

		$string = 'čini';
		$find = 'n';
		$result = Multibyte::strstr($string, $find, true);
		$expected = 'či';
		$this->assertEqual($result, $expected);

		$string = 'moći';
		$find = 'ć';
		$result = Multibyte::strstr($string, $find);
		$expected = 'ći';
		$this->assertEqual($result, $expected);

		$string = 'moći';
		$find = 'ć';
		$result = Multibyte::strstr($string, $find, true);
		$expected = 'mo';
		$this->assertEqual($result, $expected);

		$string = 'državni';
		$find = 'ž';
		$result = Multibyte::strstr($string, $find);
		$expected = 'žavni';
		$this->assertEqual($result, $expected);

		$string = 'državni';
		$find = 'ž';
		$result = Multibyte::strstr($string, $find, true);
		$expected = 'dr';
		$this->assertEqual($result, $expected);

		$string = '把百度设为首页';
		$find = '设';
		$result = Multibyte::strstr($string, $find);
		$expected = '设为首页';
		$this->assertEqual($result, $expected);

		$string = '把百度设为首页';
		$find = '设';
		$result = Multibyte::strstr($string, $find, true);
		$expected = '把百度';
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$find = '周';
		$result = Multibyte::strstr($string, $find);
		$expected = '周永龍';
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$find = '周';
		$result = Multibyte::strstr($string, $find, true);
		$expected = '一二三';
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$find = '二周';
		$result = Multibyte::strstr($string, $find);
		$expected = false;
		$this->assertEqual($result, $expected);
	}

	function testUsingMbStrtolower() {
		$string = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`ABCDEFGHIJKLMNOPQRSTUVWXYZ{|}~';
		$result = mb_strtolower($string);
		$expected = '!"#$%&\'()*+,-./0123456789:;<=>?@abcdefghijklmnopqrstuvwxyz[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$this->assertEqual($result, $expected);

		$string = '!"#$%&\'()*+,-./0123456789:;<=>?@';
		$result = mb_strtolower($string);
		$expected = '!"#$%&\'()*+,-./0123456789:;<=>?@';
		$this->assertEqual($result, $expected);

		$string = 'À';
		$result = mb_strtolower($string);
		$expected = 'à';
		$this->assertEqual($result, $expected);

		$string = 'Á';
		$result = mb_strtolower($string);
		$expected = 'á';
		$this->assertEqual($result, $expected);

		$string = 'Â';
		$result = mb_strtolower($string);
		$expected = 'â';
		$this->assertEqual($result, $expected);

		$string = 'Ã';
		$result = mb_strtolower($string);
		$expected = 'ã';
		$this->assertEqual($result, $expected);

		$string = 'Ä';
		$result = mb_strtolower($string);
		$expected = 'ä';
		$this->assertEqual($result, $expected);

		$string = 'Å';
		$result = mb_strtolower($string);
		$expected = 'å';
		$this->assertEqual($result, $expected);

		$string = 'Æ';
		$result = mb_strtolower($string);
		$expected = 'æ';
		$this->assertEqual($result, $expected);

		$string = 'Ç';
		$result = mb_strtolower($string);
		$expected = 'ç';
		$this->assertEqual($result, $expected);

		$string = 'È';
		$result = mb_strtolower($string);
		$expected = 'è';
		$this->assertEqual($result, $expected);

		$string = 'É';
		$result = mb_strtolower($string);
		$expected = 'é';
		$this->assertEqual($result, $expected);

		$string = 'Ê';
		$result = mb_strtolower($string);
		$expected = 'ê';
		$this->assertEqual($result, $expected);

		$string = 'Ë';
		$result = mb_strtolower($string);
		$expected = 'ë';
		$this->assertEqual($result, $expected);

		$string = 'Ì';
		$result = mb_strtolower($string);
		$expected = 'ì';
		$this->assertEqual($result, $expected);

		$string = 'Í';
		$result = mb_strtolower($string);
		$expected = 'í';
		$this->assertEqual($result, $expected);

		$string = 'Î';
		$result = mb_strtolower($string);
		$expected = 'î';
		$this->assertEqual($result, $expected);

		$string = 'Ï';
		$result = mb_strtolower($string);
		$expected = 'ï';
		$this->assertEqual($result, $expected);

		$string = 'Ð';
		$result = mb_strtolower($string);
		$expected = 'ð';
		$this->assertEqual($result, $expected);

		$string = 'Ñ';
		$result = mb_strtolower($string);
		$expected = 'ñ';
		$this->assertEqual($result, $expected);

		$string = 'Ò';
		$result = mb_strtolower($string);
		$expected = 'ò';
		$this->assertEqual($result, $expected);

		$string = 'Ó';
		$result = mb_strtolower($string);
		$expected = 'ó';
		$this->assertEqual($result, $expected);

		$string = 'Ô';
		$result = mb_strtolower($string);
		$expected = 'ô';
		$this->assertEqual($result, $expected);

		$string = 'Õ';
		$result = mb_strtolower($string);
		$expected = 'õ';
		$this->assertEqual($result, $expected);

		$string = 'Ö';
		$result = mb_strtolower($string);
		$expected = 'ö';
		$this->assertEqual($result, $expected);

		$string = 'Ø';
		$result = mb_strtolower($string);
		$expected = 'ø';
		$this->assertEqual($result, $expected);

		$string = 'Ù';
		$result = mb_strtolower($string);
		$expected = 'ù';
		$this->assertEqual($result, $expected);

		$string = 'Ú';
		$result = mb_strtolower($string);
		$expected = 'ú';
		$this->assertEqual($result, $expected);

		$string = 'Û';
		$result = mb_strtolower($string);
		$expected = 'û';
		$this->assertEqual($result, $expected);

		$string = 'Ü';
		$result = mb_strtolower($string);
		$expected = 'ü';
		$this->assertEqual($result, $expected);

		$string = 'Ý';
		$result = mb_strtolower($string);
		$expected = 'ý';
		$this->assertEqual($result, $expected);

		$string = 'Þ';
		$result = mb_strtolower($string);
		$expected = 'þ';
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$result = mb_strtolower($string);
		$expected = 'àáâãäåæçèéêëìíîïðñòóôõöøùúûüýþ';
		$this->assertEqual($result, $expected);

		$string = 'Ā';
		$result = mb_strtolower($string);
		$expected = 'ā';
		$this->assertEqual($result, $expected);

		$string = 'Ă';
		$result = mb_strtolower($string);
		$expected = 'ă';
		$this->assertEqual($result, $expected);

		$string = 'Ą';
		$result = mb_strtolower($string);
		$expected = 'ą';
		$this->assertEqual($result, $expected);

		$string = 'Ć';
		$result = mb_strtolower($string);
		$expected = 'ć';
		$this->assertEqual($result, $expected);

		$string = 'Ĉ';
		$result = mb_strtolower($string);
		$expected = 'ĉ';
		$this->assertEqual($result, $expected);

		$string = 'Ċ';
		$result = mb_strtolower($string);
		$expected = 'ċ';
		$this->assertEqual($result, $expected);

		$string = 'Č';
		$result = mb_strtolower($string);
		$expected = 'č';
		$this->assertEqual($result, $expected);

		$string = 'Ď';
		$result = mb_strtolower($string);
		$expected = 'ď';
		$this->assertEqual($result, $expected);

		$string = 'Đ';
		$result = mb_strtolower($string);
		$expected = 'đ';
		$this->assertEqual($result, $expected);

		$string = 'Ē';
		$result = mb_strtolower($string);
		$expected = 'ē';
		$this->assertEqual($result, $expected);

		$string = 'Ĕ';
		$result = mb_strtolower($string);
		$expected = 'ĕ';
		$this->assertEqual($result, $expected);

		$string = 'Ė';
		$result = mb_strtolower($string);
		$expected = 'ė';
		$this->assertEqual($result, $expected);

		$string = 'Ę';
		$result = mb_strtolower($string);
		$expected = 'ę';
		$this->assertEqual($result, $expected);

		$string = 'Ě';
		$result = mb_strtolower($string);
		$expected = 'ě';
		$this->assertEqual($result, $expected);

		$string = 'Ĝ';
		$result = mb_strtolower($string);
		$expected = 'ĝ';
		$this->assertEqual($result, $expected);

		$string = 'Ğ';
		$result = mb_strtolower($string);
		$expected = 'ğ';
		$this->assertEqual($result, $expected);

		$string = 'Ġ';
		$result = mb_strtolower($string);
		$expected = 'ġ';
		$this->assertEqual($result, $expected);

		$string = 'Ģ';
		$result = mb_strtolower($string);
		$expected = 'ģ';
		$this->assertEqual($result, $expected);

		$string = 'Ĥ';
		$result = mb_strtolower($string);
		$expected = 'ĥ';
		$this->assertEqual($result, $expected);

		$string = 'Ħ';
		$result = mb_strtolower($string);
		$expected = 'ħ';
		$this->assertEqual($result, $expected);

		$string = 'Ĩ';
		$result = mb_strtolower($string);
		$expected = 'ĩ';
		$this->assertEqual($result, $expected);

		$string = 'Ī';
		$result = mb_strtolower($string);
		$expected = 'ī';
		$this->assertEqual($result, $expected);

		$string = 'Ĭ';
		$result = mb_strtolower($string);
		$expected = 'ĭ';
		$this->assertEqual($result, $expected);

		$string = 'Į';
		$result = mb_strtolower($string);
		$expected = 'į';
		$this->assertEqual($result, $expected);

		$string = 'Ĳ';
		$result = mb_strtolower($string);
		$expected = 'ĳ';
		$this->assertEqual($result, $expected);

		$string = 'Ĵ';
		$result = mb_strtolower($string);
		$expected = 'ĵ';
		$this->assertEqual($result, $expected);

		$string = 'Ķ';
		$result = mb_strtolower($string);
		$expected = 'ķ';
		$this->assertEqual($result, $expected);

		$string = 'Ĺ';
		$result = mb_strtolower($string);
		$expected = 'ĺ';
		$this->assertEqual($result, $expected);

		$string = 'Ļ';
		$result = mb_strtolower($string);
		$expected = 'ļ';
		$this->assertEqual($result, $expected);

		$string = 'Ľ';
		$result = mb_strtolower($string);
		$expected = 'ľ';
		$this->assertEqual($result, $expected);

		$string = 'Ŀ';
		$result = mb_strtolower($string);
		$expected = 'ŀ';
		$this->assertEqual($result, $expected);

		$string = 'Ł';
		$result = mb_strtolower($string);
		$expected = 'ł';
		$this->assertEqual($result, $expected);

		$string = 'Ń';
		$result = mb_strtolower($string);
		$expected = 'ń';
		$this->assertEqual($result, $expected);

		$string = 'Ņ';
		$result = mb_strtolower($string);
		$expected = 'ņ';
		$this->assertEqual($result, $expected);

		$string = 'Ň';
		$result = mb_strtolower($string);
		$expected = 'ň';
		$this->assertEqual($result, $expected);

		$string = 'Ŋ';
		$result = mb_strtolower($string);
		$expected = 'ŋ';
		$this->assertEqual($result, $expected);

		$string = 'Ō';
		$result = mb_strtolower($string);
		$expected = 'ō';
		$this->assertEqual($result, $expected);

		$string = 'Ŏ';
		$result = mb_strtolower($string);
		$expected = 'ŏ';
		$this->assertEqual($result, $expected);

		$string = 'Ő';
		$result = mb_strtolower($string);
		$expected = 'ő';
		$this->assertEqual($result, $expected);

		$string = 'Œ';
		$result = mb_strtolower($string);
		$expected = 'œ';
		$this->assertEqual($result, $expected);

		$string = 'Ŕ';
		$result = mb_strtolower($string);
		$expected = 'ŕ';
		$this->assertEqual($result, $expected);

		$string = 'Ŗ';
		$result = mb_strtolower($string);
		$expected = 'ŗ';
		$this->assertEqual($result, $expected);

		$string = 'Ř';
		$result = mb_strtolower($string);
		$expected = 'ř';
		$this->assertEqual($result, $expected);

		$string = 'Ś';
		$result = mb_strtolower($string);
		$expected = 'ś';
		$this->assertEqual($result, $expected);

		$string = 'Ŝ';
		$result = mb_strtolower($string);
		$expected = 'ŝ';
		$this->assertEqual($result, $expected);

		$string = 'Ş';
		$result = mb_strtolower($string);
		$expected = 'ş';
		$this->assertEqual($result, $expected);

		$string = 'Š';
		$result = mb_strtolower($string);
		$expected = 'š';
		$this->assertEqual($result, $expected);

		$string = 'Ţ';
		$result = mb_strtolower($string);
		$expected = 'ţ';
		$this->assertEqual($result, $expected);

		$string = 'Ť';
		$result = mb_strtolower($string);
		$expected = 'ť';
		$this->assertEqual($result, $expected);

		$string = 'Ŧ';
		$result = mb_strtolower($string);
		$expected = 'ŧ';
		$this->assertEqual($result, $expected);

		$string = 'Ũ';
		$result = mb_strtolower($string);
		$expected = 'ũ';
		$this->assertEqual($result, $expected);

		$string = 'Ū';
		$result = mb_strtolower($string);
		$expected = 'ū';
		$this->assertEqual($result, $expected);

		$string = 'Ŭ';
		$result = mb_strtolower($string);
		$expected = 'ŭ';
		$this->assertEqual($result, $expected);

		$string = 'Ů';
		$result = mb_strtolower($string);
		$expected = 'ů';
		$this->assertEqual($result, $expected);

		$string = 'Ű';
		$result = mb_strtolower($string);
		$expected = 'ű';
		$this->assertEqual($result, $expected);

		$string = 'Ų';
		$result = mb_strtolower($string);
		$expected = 'ų';
		$this->assertEqual($result, $expected);

		$string = 'Ŵ';
		$result = mb_strtolower($string);
		$expected = 'ŵ';
		$this->assertEqual($result, $expected);

		$string = 'Ŷ';
		$result = mb_strtolower($string);
		$expected = 'ŷ';
		$this->assertEqual($result, $expected);

		$string = 'Ź';
		$result = mb_strtolower($string);
		$expected = 'ź';
		$this->assertEqual($result, $expected);

		$string = 'Ż';
		$result = mb_strtolower($string);
		$expected = 'ż';
		$this->assertEqual($result, $expected);

		$string = 'Ž';
		$result = mb_strtolower($string);
		$expected = 'ž';
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$result = mb_strtolower($string);
		$expected = 'āăąćĉċčďđēĕėęěĝğġģĥħĩīĭįĳĵķĺļľŀłńņňŋōŏőœŕŗřśŝşšţťŧũūŭůűųŵŷźżž';
		$this->assertEqual($result, $expected);

		$string = 'ĤĒĹĻŎ, ŴŐŘĻĎ!';
		$result = mb_strtolower($string);
		$expected = 'ĥēĺļŏ, ŵőřļď!';
		$this->assertEqual($result, $expected);

		$string = 'ĥēĺļŏ, ŵőřļď!';
		$result = mb_strtolower($string);
		$expected = 'ĥēĺļŏ, ŵőřļď!';
		$this->assertEqual($result, $expected);

		$string = 'ἈΙ';
		$result = mb_strtolower($string);
		$expected = 'ἀι';
		$this->assertEqual($result, $expected);
	}

	function testMultibyteStrtolower() {
		$string = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`ABCDEFGHIJKLMNOPQRSTUVWXYZ{|}~';
		$result = Multibyte::strtolower($string);
		$expected = '!"#$%&\'()*+,-./0123456789:;<=>?@abcdefghijklmnopqrstuvwxyz[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$this->assertEqual($result, $expected);

		$string = '!"#$%&\'()*+,-./0123456789:;<=>?@';
		$result = Multibyte::strtolower($string);
		$expected = '!"#$%&\'()*+,-./0123456789:;<=>?@';
		$this->assertEqual($result, $expected);

		$string = 'À';
		$result = Multibyte::strtolower($string);
		$expected = 'à';
		$this->assertEqual($result, $expected);

		$string = 'Á';
		$result = Multibyte::strtolower($string);
		$expected = 'á';
		$this->assertEqual($result, $expected);

		$string = 'Â';
		$result = Multibyte::strtolower($string);
		$expected = 'â';
		$this->assertEqual($result, $expected);

		$string = 'Ã';
		$result = Multibyte::strtolower($string);
		$expected = 'ã';
		$this->assertEqual($result, $expected);

		$string = 'Ä';
		$result = Multibyte::strtolower($string);
		$expected = 'ä';
		$this->assertEqual($result, $expected);

		$string = 'Å';
		$result = Multibyte::strtolower($string);
		$expected = 'å';
		$this->assertEqual($result, $expected);

		$string = 'Æ';
		$result = Multibyte::strtolower($string);
		$expected = 'æ';
		$this->assertEqual($result, $expected);

		$string = 'Ç';
		$result = Multibyte::strtolower($string);
		$expected = 'ç';
		$this->assertEqual($result, $expected);

		$string = 'È';
		$result = Multibyte::strtolower($string);
		$expected = 'è';
		$this->assertEqual($result, $expected);

		$string = 'É';
		$result = Multibyte::strtolower($string);
		$expected = 'é';
		$this->assertEqual($result, $expected);

		$string = 'Ê';
		$result = Multibyte::strtolower($string);
		$expected = 'ê';
		$this->assertEqual($result, $expected);

		$string = 'Ë';
		$result = Multibyte::strtolower($string);
		$expected = 'ë';
		$this->assertEqual($result, $expected);

		$string = 'Ì';
		$result = Multibyte::strtolower($string);
		$expected = 'ì';
		$this->assertEqual($result, $expected);

		$string = 'Í';
		$result = Multibyte::strtolower($string);
		$expected = 'í';
		$this->assertEqual($result, $expected);

		$string = 'Î';
		$result = Multibyte::strtolower($string);
		$expected = 'î';
		$this->assertEqual($result, $expected);

		$string = 'Ï';
		$result = Multibyte::strtolower($string);
		$expected = 'ï';
		$this->assertEqual($result, $expected);

		$string = 'Ð';
		$result = Multibyte::strtolower($string);
		$expected = 'ð';
		$this->assertEqual($result, $expected);

		$string = 'Ñ';
		$result = Multibyte::strtolower($string);
		$expected = 'ñ';
		$this->assertEqual($result, $expected);

		$string = 'Ò';
		$result = Multibyte::strtolower($string);
		$expected = 'ò';
		$this->assertEqual($result, $expected);

		$string = 'Ó';
		$result = Multibyte::strtolower($string);
		$expected = 'ó';
		$this->assertEqual($result, $expected);

		$string = 'Ô';
		$result = Multibyte::strtolower($string);
		$expected = 'ô';
		$this->assertEqual($result, $expected);

		$string = 'Õ';
		$result = Multibyte::strtolower($string);
		$expected = 'õ';
		$this->assertEqual($result, $expected);

		$string = 'Ö';
		$result = Multibyte::strtolower($string);
		$expected = 'ö';
		$this->assertEqual($result, $expected);

		$string = 'Ø';
		$result = Multibyte::strtolower($string);
		$expected = 'ø';
		$this->assertEqual($result, $expected);

		$string = 'Ù';
		$result = Multibyte::strtolower($string);
		$expected = 'ù';
		$this->assertEqual($result, $expected);

		$string = 'Ú';
		$result = Multibyte::strtolower($string);
		$expected = 'ú';
		$this->assertEqual($result, $expected);

		$string = 'Û';
		$result = Multibyte::strtolower($string);
		$expected = 'û';
		$this->assertEqual($result, $expected);

		$string = 'Ü';
		$result = Multibyte::strtolower($string);
		$expected = 'ü';
		$this->assertEqual($result, $expected);

		$string = 'Ý';
		$result = Multibyte::strtolower($string);
		$expected = 'ý';
		$this->assertEqual($result, $expected);

		$string = 'Þ';
		$result = Multibyte::strtolower($string);
		$expected = 'þ';
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$result = Multibyte::strtolower($string);
		$expected = 'àáâãäåæçèéêëìíîïðñòóôõöøùúûüýþ';
		$this->assertEqual($result, $expected);

		$string = 'Ā';
		$result = Multibyte::strtolower($string);
		$expected = 'ā';
		$this->assertEqual($result, $expected);

		$string = 'Ă';
		$result = Multibyte::strtolower($string);
		$expected = 'ă';
		$this->assertEqual($result, $expected);

		$string = 'Ą';
		$result = Multibyte::strtolower($string);
		$expected = 'ą';
		$this->assertEqual($result, $expected);

		$string = 'Ć';
		$result = Multibyte::strtolower($string);
		$expected = 'ć';
		$this->assertEqual($result, $expected);

		$string = 'Ĉ';
		$result = Multibyte::strtolower($string);
		$expected = 'ĉ';
		$this->assertEqual($result, $expected);

		$string = 'Ċ';
		$result = Multibyte::strtolower($string);
		$expected = 'ċ';
		$this->assertEqual($result, $expected);

		$string = 'Č';
		$result = Multibyte::strtolower($string);
		$expected = 'č';
		$this->assertEqual($result, $expected);

		$string = 'Ď';
		$result = Multibyte::strtolower($string);
		$expected = 'ď';
		$this->assertEqual($result, $expected);

		$string = 'Đ';
		$result = Multibyte::strtolower($string);
		$expected = 'đ';
		$this->assertEqual($result, $expected);

		$string = 'Ē';
		$result = Multibyte::strtolower($string);
		$expected = 'ē';
		$this->assertEqual($result, $expected);

		$string = 'Ĕ';
		$result = Multibyte::strtolower($string);
		$expected = 'ĕ';
		$this->assertEqual($result, $expected);

		$string = 'Ė';
		$result = Multibyte::strtolower($string);
		$expected = 'ė';
		$this->assertEqual($result, $expected);

		$string = 'Ę';
		$result = Multibyte::strtolower($string);
		$expected = 'ę';
		$this->assertEqual($result, $expected);

		$string = 'Ě';
		$result = Multibyte::strtolower($string);
		$expected = 'ě';
		$this->assertEqual($result, $expected);

		$string = 'Ĝ';
		$result = Multibyte::strtolower($string);
		$expected = 'ĝ';
		$this->assertEqual($result, $expected);

		$string = 'Ğ';
		$result = Multibyte::strtolower($string);
		$expected = 'ğ';
		$this->assertEqual($result, $expected);

		$string = 'Ġ';
		$result = Multibyte::strtolower($string);
		$expected = 'ġ';
		$this->assertEqual($result, $expected);

		$string = 'Ģ';
		$result = Multibyte::strtolower($string);
		$expected = 'ģ';
		$this->assertEqual($result, $expected);

		$string = 'Ĥ';
		$result = Multibyte::strtolower($string);
		$expected = 'ĥ';
		$this->assertEqual($result, $expected);

		$string = 'Ħ';
		$result = Multibyte::strtolower($string);
		$expected = 'ħ';
		$this->assertEqual($result, $expected);

		$string = 'Ĩ';
		$result = Multibyte::strtolower($string);
		$expected = 'ĩ';
		$this->assertEqual($result, $expected);

		$string = 'Ī';
		$result = Multibyte::strtolower($string);
		$expected = 'ī';
		$this->assertEqual($result, $expected);

		$string = 'Ĭ';
		$result = Multibyte::strtolower($string);
		$expected = 'ĭ';
		$this->assertEqual($result, $expected);

		$string = 'Į';
		$result = Multibyte::strtolower($string);
		$expected = 'į';
		$this->assertEqual($result, $expected);

		$string = 'Ĳ';
		$result = Multibyte::strtolower($string);
		$expected = 'ĳ';
		$this->assertEqual($result, $expected);

		$string = 'Ĵ';
		$result = Multibyte::strtolower($string);
		$expected = 'ĵ';
		$this->assertEqual($result, $expected);

		$string = 'Ķ';
		$result = Multibyte::strtolower($string);
		$expected = 'ķ';
		$this->assertEqual($result, $expected);

		$string = 'Ĺ';
		$result = Multibyte::strtolower($string);
		$expected = 'ĺ';
		$this->assertEqual($result, $expected);

		$string = 'Ļ';
		$result = Multibyte::strtolower($string);
		$expected = 'ļ';
		$this->assertEqual($result, $expected);

		$string = 'Ľ';
		$result = Multibyte::strtolower($string);
		$expected = 'ľ';
		$this->assertEqual($result, $expected);

		$string = 'Ŀ';
		$result = Multibyte::strtolower($string);
		$expected = 'ŀ';
		$this->assertEqual($result, $expected);

		$string = 'Ł';
		$result = Multibyte::strtolower($string);
		$expected = 'ł';
		$this->assertEqual($result, $expected);

		$string = 'Ń';
		$result = Multibyte::strtolower($string);
		$expected = 'ń';
		$this->assertEqual($result, $expected);

		$string = 'Ņ';
		$result = Multibyte::strtolower($string);
		$expected = 'ņ';
		$this->assertEqual($result, $expected);

		$string = 'Ň';
		$result = Multibyte::strtolower($string);
		$expected = 'ň';
		$this->assertEqual($result, $expected);

		$string = 'Ŋ';
		$result = Multibyte::strtolower($string);
		$expected = 'ŋ';
		$this->assertEqual($result, $expected);

		$string = 'Ō';
		$result = Multibyte::strtolower($string);
		$expected = 'ō';
		$this->assertEqual($result, $expected);

		$string = 'Ŏ';
		$result = Multibyte::strtolower($string);
		$expected = 'ŏ';
		$this->assertEqual($result, $expected);

		$string = 'Ő';
		$result = Multibyte::strtolower($string);
		$expected = 'ő';
		$this->assertEqual($result, $expected);

		$string = 'Œ';
		$result = Multibyte::strtolower($string);
		$expected = 'œ';
		$this->assertEqual($result, $expected);

		$string = 'Ŕ';
		$result = Multibyte::strtolower($string);
		$expected = 'ŕ';
		$this->assertEqual($result, $expected);

		$string = 'Ŗ';
		$result = Multibyte::strtolower($string);
		$expected = 'ŗ';
		$this->assertEqual($result, $expected);

		$string = 'Ř';
		$result = Multibyte::strtolower($string);
		$expected = 'ř';
		$this->assertEqual($result, $expected);

		$string = 'Ś';
		$result = Multibyte::strtolower($string);
		$expected = 'ś';
		$this->assertEqual($result, $expected);

		$string = 'Ŝ';
		$result = Multibyte::strtolower($string);
		$expected = 'ŝ';
		$this->assertEqual($result, $expected);

		$string = 'Ş';
		$result = Multibyte::strtolower($string);
		$expected = 'ş';
		$this->assertEqual($result, $expected);

		$string = 'Š';
		$result = Multibyte::strtolower($string);
		$expected = 'š';
		$this->assertEqual($result, $expected);

		$string = 'Ţ';
		$result = Multibyte::strtolower($string);
		$expected = 'ţ';
		$this->assertEqual($result, $expected);

		$string = 'Ť';
		$result = Multibyte::strtolower($string);
		$expected = 'ť';
		$this->assertEqual($result, $expected);

		$string = 'Ŧ';
		$result = Multibyte::strtolower($string);
		$expected = 'ŧ';
		$this->assertEqual($result, $expected);

		$string = 'Ũ';
		$result = Multibyte::strtolower($string);
		$expected = 'ũ';
		$this->assertEqual($result, $expected);

		$string = 'Ū';
		$result = Multibyte::strtolower($string);
		$expected = 'ū';
		$this->assertEqual($result, $expected);

		$string = 'Ŭ';
		$result = Multibyte::strtolower($string);
		$expected = 'ŭ';
		$this->assertEqual($result, $expected);

		$string = 'Ů';
		$result = Multibyte::strtolower($string);
		$expected = 'ů';
		$this->assertEqual($result, $expected);

		$string = 'Ű';
		$result = Multibyte::strtolower($string);
		$expected = 'ű';
		$this->assertEqual($result, $expected);

		$string = 'Ų';
		$result = Multibyte::strtolower($string);
		$expected = 'ų';
		$this->assertEqual($result, $expected);

		$string = 'Ŵ';
		$result = Multibyte::strtolower($string);
		$expected = 'ŵ';
		$this->assertEqual($result, $expected);

		$string = 'Ŷ';
		$result = Multibyte::strtolower($string);
		$expected = 'ŷ';
		$this->assertEqual($result, $expected);

		$string = 'Ź';
		$result = Multibyte::strtolower($string);
		$expected = 'ź';
		$this->assertEqual($result, $expected);

		$string = 'Ż';
		$result = Multibyte::strtolower($string);
		$expected = 'ż';
		$this->assertEqual($result, $expected);

		$string = 'Ž';
		$result = Multibyte::strtolower($string);
		$expected = 'ž';
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$result = Multibyte::strtolower($string);
		$expected = 'āăąćĉċčďđēĕėęěĝğġģĥħĩīĭįĳĵķĺļľŀłńņňŋōŏőœŕŗřśŝşšţťŧũūŭůűųŵŷźżž';
		$this->assertEqual($result, $expected);

		$string = 'ĤĒĹĻŎ, ŴŐŘĻĎ!';
		$result = Multibyte::strtolower($string);
		$expected = 'ĥēĺļŏ, ŵőřļď!';
		$this->assertEqual($result, $expected);

		$string = 'ĥēĺļŏ, ŵőřļď!';
		$result = Multibyte::strtolower($string);
		$expected = 'ĥēĺļŏ, ŵőřļď!';
		$this->assertEqual($result, $expected);

		$string = 'ἈΙ';
		$result = Multibyte::strtolower($string);
		$expected = 'ἀι';
		$this->assertEqual($result, $expected);
	}

	function testUsingMbStrtoupper() {
		$string = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$result = mb_strtoupper($string);
		$expected = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`ABCDEFGHIJKLMNOPQRSTUVWXYZ{|}~';
		$this->assertEqual($result, $expected);

		$string = '!"#$%&\'()*+,-./0123456789:;<=>?@';
		$result = mb_strtoupper($string);
		$expected = '!"#$%&\'()*+,-./0123456789:;<=>?@';
		$this->assertEqual($result, $expected);

		$string = 'à';
		$result = mb_strtoupper($string);
		$expected = 'À';
		$this->assertEqual($result, $expected);

		$string = 'á';
		$result = mb_strtoupper($string);
		$expected = 'Á';
		$this->assertEqual($result, $expected);

		$string = 'â';
		$result = mb_strtoupper($string);
		$expected = 'Â';
		$this->assertEqual($result, $expected);

		$string = 'ã';
		$result = mb_strtoupper($string);
		$expected = 'Ã';
		$this->assertEqual($result, $expected);

		$string = 'ä';
		$result = mb_strtoupper($string);
		$expected = 'Ä';
		$this->assertEqual($result, $expected);

		$string = 'å';
		$result = mb_strtoupper($string);
		$expected = 'Å';
		$this->assertEqual($result, $expected);

		$string = 'æ';
		$result = mb_strtoupper($string);
		$expected = 'Æ';
		$this->assertEqual($result, $expected);

		$string = 'ç';
		$result = mb_strtoupper($string);
		$expected = 'Ç';
		$this->assertEqual($result, $expected);

		$string = 'è';
		$result = mb_strtoupper($string);
		$expected = 'È';
		$this->assertEqual($result, $expected);

		$string = 'é';
		$result = mb_strtoupper($string);
		$expected = 'É';
		$this->assertEqual($result, $expected);

		$string = 'ê';
		$result = mb_strtoupper($string);
		$expected = 'Ê';
		$this->assertEqual($result, $expected);

		$string = 'ë';
		$result = mb_strtoupper($string);
		$expected = 'Ë';
		$this->assertEqual($result, $expected);

		$string = 'ì';
		$result = mb_strtoupper($string);
		$expected = 'Ì';
		$this->assertEqual($result, $expected);

		$string = 'í';
		$result = mb_strtoupper($string);
		$expected = 'Í';
		$this->assertEqual($result, $expected);

		$string = 'î';
		$result = mb_strtoupper($string);
		$expected = 'Î';
		$this->assertEqual($result, $expected);

		$string = 'ï';
		$result = mb_strtoupper($string);
		$expected = 'Ï';
		$this->assertEqual($result, $expected);

		$string = 'ð';
		$result = mb_strtoupper($string);
		$expected = 'Ð';
		$this->assertEqual($result, $expected);

		$string = 'ñ';
		$result = mb_strtoupper($string);
		$expected = 'Ñ';
		$this->assertEqual($result, $expected);

		$string = 'ò';
		$result = mb_strtoupper($string);
		$expected = 'Ò';
		$this->assertEqual($result, $expected);

		$string = 'ó';
		$result = mb_strtoupper($string);
		$expected = 'Ó';
		$this->assertEqual($result, $expected);

		$string = 'ô';
		$result = mb_strtoupper($string);
		$expected = 'Ô';
		$this->assertEqual($result, $expected);

		$string = 'õ';
		$result = mb_strtoupper($string);
		$expected = 'Õ';
		$this->assertEqual($result, $expected);

		$string = 'ö';
		$result = mb_strtoupper($string);
		$expected = 'Ö';
		$this->assertEqual($result, $expected);

		$string = 'ø';
		$result = mb_strtoupper($string);
		$expected = 'Ø';
		$this->assertEqual($result, $expected);

		$string = 'ù';
		$result = mb_strtoupper($string);
		$expected = 'Ù';
		$this->assertEqual($result, $expected);

		$string = 'ú';
		$result = mb_strtoupper($string);
		$expected = 'Ú';
		$this->assertEqual($result, $expected);

		$string = 'û';
		$result = mb_strtoupper($string);
		$expected = 'Û';
		$this->assertEqual($result, $expected);

		$string = 'ü';
		$result = mb_strtoupper($string);
		$expected = 'Ü';
		$this->assertEqual($result, $expected);

		$string = 'ý';
		$result = mb_strtoupper($string);
		$expected = 'Ý';
		$this->assertEqual($result, $expected);

		$string = 'þ';
		$result = mb_strtoupper($string);
		$expected = 'Þ';
		$this->assertEqual($result, $expected);

		$string = 'àáâãäåæçèéêëìíîïðñòóôõöøùúûüýþ';
		$result = mb_strtoupper($string);
		$expected = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$this->assertEqual($result, $expected);

		$string = 'ā';
		$result = mb_strtoupper($string);
		$expected = 'Ā';
		$this->assertEqual($result, $expected);

		$string = 'ă';
		$result = mb_strtoupper($string);
		$expected = 'Ă';
		$this->assertEqual($result, $expected);

		$string = 'ą';
		$result = mb_strtoupper($string);
		$expected = 'Ą';
		$this->assertEqual($result, $expected);

		$string = 'ć';
		$result = mb_strtoupper($string);
		$expected = 'Ć';
		$this->assertEqual($result, $expected);

		$string = 'ĉ';
		$result = mb_strtoupper($string);
		$expected = 'Ĉ';
		$this->assertEqual($result, $expected);

		$string = 'ċ';
		$result = mb_strtoupper($string);
		$expected = 'Ċ';
		$this->assertEqual($result, $expected);

		$string = 'č';
		$result = mb_strtoupper($string);
		$expected = 'Č';
		$this->assertEqual($result, $expected);

		$string = 'ď';
		$result = mb_strtoupper($string);
		$expected = 'Ď';
		$this->assertEqual($result, $expected);

		$string = 'đ';
		$result = mb_strtoupper($string);
		$expected = 'Đ';
		$this->assertEqual($result, $expected);

		$string = 'ē';
		$result = mb_strtoupper($string);
		$expected = 'Ē';
		$this->assertEqual($result, $expected);

		$string = 'ĕ';
		$result = mb_strtoupper($string);
		$expected = 'Ĕ';
		$this->assertEqual($result, $expected);

		$string = 'ė';
		$result = mb_strtoupper($string);
		$expected = 'Ė';
		$this->assertEqual($result, $expected);

		$string = 'ę';
		$result = mb_strtoupper($string);
		$expected = 'Ę';
		$this->assertEqual($result, $expected);

		$string = 'ě';
		$result = mb_strtoupper($string);
		$expected = 'Ě';
		$this->assertEqual($result, $expected);

		$string = 'ĝ';
		$result = mb_strtoupper($string);
		$expected = 'Ĝ';
		$this->assertEqual($result, $expected);

		$string = 'ğ';
		$result = mb_strtoupper($string);
		$expected = 'Ğ';
		$this->assertEqual($result, $expected);

		$string = 'ġ';
		$result = mb_strtoupper($string);
		$expected = 'Ġ';
		$this->assertEqual($result, $expected);

		$string = 'ģ';
		$result = mb_strtoupper($string);
		$expected = 'Ģ';
		$this->assertEqual($result, $expected);

		$string = 'ĥ';
		$result = mb_strtoupper($string);
		$expected = 'Ĥ';
		$this->assertEqual($result, $expected);

		$string = 'ħ';
		$result = mb_strtoupper($string);
		$expected = 'Ħ';
		$this->assertEqual($result, $expected);

		$string = 'ĩ';
		$result = mb_strtoupper($string);
		$expected = 'Ĩ';
		$this->assertEqual($result, $expected);

		$string = 'ī';
		$result = mb_strtoupper($string);
		$expected = 'Ī';
		$this->assertEqual($result, $expected);

		$string = 'ĭ';
		$result = mb_strtoupper($string);
		$expected = 'Ĭ';
		$this->assertEqual($result, $expected);

		$string = 'į';
		$result = mb_strtoupper($string);
		$expected = 'Į';
		$this->assertEqual($result, $expected);

		$string = 'ĳ';
		$result = mb_strtoupper($string);
		$expected = 'Ĳ';
		$this->assertEqual($result, $expected);

		$string = 'ĵ';
		$result = mb_strtoupper($string);
		$expected = 'Ĵ';
		$this->assertEqual($result, $expected);

		$string = 'ķ';
		$result = mb_strtoupper($string);
		$expected = 'Ķ';
		$this->assertEqual($result, $expected);

		$string = 'ĺ';
		$result = mb_strtoupper($string);
		$expected = 'Ĺ';
		$this->assertEqual($result, $expected);

		$string = 'ļ';
		$result = mb_strtoupper($string);
		$expected = 'Ļ';
		$this->assertEqual($result, $expected);

		$string = 'ľ';
		$result = mb_strtoupper($string);
		$expected = 'Ľ';
		$this->assertEqual($result, $expected);

		$string = 'ŀ';
		$result = mb_strtoupper($string);
		$expected = 'Ŀ';
		$this->assertEqual($result, $expected);

		$string = 'ł';
		$result = mb_strtoupper($string);
		$expected = 'Ł';
		$this->assertEqual($result, $expected);

		$string = 'ń';
		$result = mb_strtoupper($string);
		$expected = 'Ń';
		$this->assertEqual($result, $expected);

		$string = 'ņ';
		$result = mb_strtoupper($string);
		$expected = 'Ņ';
		$this->assertEqual($result, $expected);

		$string = 'ň';
		$result = mb_strtoupper($string);
		$expected = 'Ň';
		$this->assertEqual($result, $expected);

		$string = 'ŋ';
		$result = mb_strtoupper($string);
		$expected = 'Ŋ';
		$this->assertEqual($result, $expected);

		$string = 'ō';
		$result = mb_strtoupper($string);
		$expected = 'Ō';
		$this->assertEqual($result, $expected);

		$string = 'ŏ';
		$result = mb_strtoupper($string);
		$expected = 'Ŏ';
		$this->assertEqual($result, $expected);

		$string = 'ő';
		$result = mb_strtoupper($string);
		$expected = 'Ő';
		$this->assertEqual($result, $expected);

		$string = 'œ';
		$result = mb_strtoupper($string);
		$expected = 'Œ';
		$this->assertEqual($result, $expected);

		$string = 'ŕ';
		$result = mb_strtoupper($string);
		$expected = 'Ŕ';
		$this->assertEqual($result, $expected);

		$string = 'ŗ';
		$result = mb_strtoupper($string);
		$expected = 'Ŗ';
		$this->assertEqual($result, $expected);

		$string = 'ř';
		$result = mb_strtoupper($string);
		$expected = 'Ř';
		$this->assertEqual($result, $expected);

		$string = 'ś';
		$result = mb_strtoupper($string);
		$expected = 'Ś';
		$this->assertEqual($result, $expected);

		$string = 'ŝ';
		$result = mb_strtoupper($string);
		$expected = 'Ŝ';
		$this->assertEqual($result, $expected);

		$string = 'ş';
		$result = mb_strtoupper($string);
		$expected = 'Ş';
		$this->assertEqual($result, $expected);

		$string = 'š';
		$result = mb_strtoupper($string);
		$expected = 'Š';
		$this->assertEqual($result, $expected);

		$string = 'ţ';
		$result = mb_strtoupper($string);
		$expected = 'Ţ';
		$this->assertEqual($result, $expected);

		$string = 'ť';
		$result = mb_strtoupper($string);
		$expected = 'Ť';
		$this->assertEqual($result, $expected);

		$string = 'ŧ';
		$result = mb_strtoupper($string);
		$expected = 'Ŧ';
		$this->assertEqual($result, $expected);

		$string = 'ũ';
		$result = mb_strtoupper($string);
		$expected = 'Ũ';
		$this->assertEqual($result, $expected);

		$string = 'ū';
		$result = mb_strtoupper($string);
		$expected = 'Ū';
		$this->assertEqual($result, $expected);

		$string = 'ŭ';
		$result = mb_strtoupper($string);
		$expected = 'Ŭ';
		$this->assertEqual($result, $expected);

		$string = 'ů';
		$result = mb_strtoupper($string);
		$expected = 'Ů';
		$this->assertEqual($result, $expected);

		$string = 'ű';
		$result = mb_strtoupper($string);
		$expected = 'Ű';
		$this->assertEqual($result, $expected);

		$string = 'ų';
		$result = mb_strtoupper($string);
		$expected = 'Ų';
		$this->assertEqual($result, $expected);

		$string = 'ŵ';
		$result = mb_strtoupper($string);
		$expected = 'Ŵ';
		$this->assertEqual($result, $expected);

		$string = 'ŷ';
		$result = mb_strtoupper($string);
		$expected = 'Ŷ';
		$this->assertEqual($result, $expected);

		$string = 'ź';
		$result = mb_strtoupper($string);
		$expected = 'Ź';
		$this->assertEqual($result, $expected);

		$string = 'ż';
		$result = mb_strtoupper($string);
		$expected = 'Ż';
		$this->assertEqual($result, $expected);

		$string = 'ž';
		$result = mb_strtoupper($string);
		$expected = 'Ž';
		$this->assertEqual($result, $expected);

		$string = 'āăąćĉċčďđēĕėęěĝğġģĥħĩīĭįĳĵķĺļľŀłńņňŋōŏőœŕŗřśŝşšţťŧũūŭůűųŵŷźżž';
		$result = mb_strtoupper($string);
		$expected = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$result = mb_strtoupper($string);
		$expected = 'ĤĒĹĻŎ, ŴŐŘĻĎ!';
		$this->assertEqual($result, $expected);

		$string = 'ἀι';
		$result = mb_strtoupper($string);
		$expected = 'ἈΙ';
		$this->assertEqual($result, $expected);
	}

	function testMultibyteStrtoupper() {
		$string = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$result = Multibyte::strtoupper($string);
		$expected = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`ABCDEFGHIJKLMNOPQRSTUVWXYZ{|}~';
		$this->assertEqual($result, $expected);

		$string = '!"#$%&\'()*+,-./0123456789:;<=>?@';
		$result = Multibyte::strtoupper($string);
		$expected = '!"#$%&\'()*+,-./0123456789:;<=>?@';
		$this->assertEqual($result, $expected);

		$string = 'à';
		$result = Multibyte::strtoupper($string);
		$expected = 'À';
		$this->assertEqual($result, $expected);

		$string = 'á';
		$result = Multibyte::strtoupper($string);
		$expected = 'Á';
		$this->assertEqual($result, $expected);

		$string = 'â';
		$result = Multibyte::strtoupper($string);
		$expected = 'Â';
		$this->assertEqual($result, $expected);

		$string = 'ã';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ã';
		$this->assertEqual($result, $expected);

		$string = 'ä';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ä';
		$this->assertEqual($result, $expected);

		$string = 'å';
		$result = Multibyte::strtoupper($string);
		$expected = 'Å';
		$this->assertEqual($result, $expected);

		$string = 'æ';
		$result = Multibyte::strtoupper($string);
		$expected = 'Æ';
		$this->assertEqual($result, $expected);

		$string = 'ç';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ç';
		$this->assertEqual($result, $expected);

		$string = 'è';
		$result = Multibyte::strtoupper($string);
		$expected = 'È';
		$this->assertEqual($result, $expected);

		$string = 'é';
		$result = Multibyte::strtoupper($string);
		$expected = 'É';
		$this->assertEqual($result, $expected);

		$string = 'ê';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ê';
		$this->assertEqual($result, $expected);

		$string = 'ë';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ë';
		$this->assertEqual($result, $expected);

		$string = 'ì';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ì';
		$this->assertEqual($result, $expected);

		$string = 'í';
		$result = Multibyte::strtoupper($string);
		$expected = 'Í';
		$this->assertEqual($result, $expected);

		$string = 'î';
		$result = Multibyte::strtoupper($string);
		$expected = 'Î';
		$this->assertEqual($result, $expected);

		$string = 'ï';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ï';
		$this->assertEqual($result, $expected);

		$string = 'ð';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ð';
		$this->assertEqual($result, $expected);

		$string = 'ñ';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ñ';
		$this->assertEqual($result, $expected);

		$string = 'ò';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ò';
		$this->assertEqual($result, $expected);

		$string = 'ó';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ó';
		$this->assertEqual($result, $expected);

		$string = 'ô';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ô';
		$this->assertEqual($result, $expected);

		$string = 'õ';
		$result = Multibyte::strtoupper($string);
		$expected = 'Õ';
		$this->assertEqual($result, $expected);

		$string = 'ö';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ö';
		$this->assertEqual($result, $expected);

		$string = 'ø';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ø';
		$this->assertEqual($result, $expected);

		$string = 'ù';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ù';
		$this->assertEqual($result, $expected);

		$string = 'ú';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ú';
		$this->assertEqual($result, $expected);

		$string = 'û';
		$result = Multibyte::strtoupper($string);
		$expected = 'Û';
		$this->assertEqual($result, $expected);

		$string = 'ü';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ü';
		$this->assertEqual($result, $expected);

		$string = 'ý';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ý';
		$this->assertEqual($result, $expected);

		$string = 'þ';
		$result = Multibyte::strtoupper($string);
		$expected = 'Þ';
		$this->assertEqual($result, $expected);

		$string = 'àáâãäåæçèéêëìíîïðñòóôõöøùúûüýþ';
		$result = Multibyte::strtoupper($string);
		$expected = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$this->assertEqual($result, $expected);

		$string = 'ā';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ā';
		$this->assertEqual($result, $expected);

		$string = 'ă';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ă';
		$this->assertEqual($result, $expected);

		$string = 'ą';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ą';
		$this->assertEqual($result, $expected);

		$string = 'ć';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ć';
		$this->assertEqual($result, $expected);

		$string = 'ĉ';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ĉ';
		$this->assertEqual($result, $expected);

		$string = 'ċ';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ċ';
		$this->assertEqual($result, $expected);

		$string = 'č';
		$result = Multibyte::strtoupper($string);
		$expected = 'Č';
		$this->assertEqual($result, $expected);

		$string = 'ď';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ď';
		$this->assertEqual($result, $expected);

		$string = 'đ';
		$result = Multibyte::strtoupper($string);
		$expected = 'Đ';
		$this->assertEqual($result, $expected);

		$string = 'ē';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ē';
		$this->assertEqual($result, $expected);

		$string = 'ĕ';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ĕ';
		$this->assertEqual($result, $expected);

		$string = 'ė';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ė';
		$this->assertEqual($result, $expected);

		$string = 'ę';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ę';
		$this->assertEqual($result, $expected);

		$string = 'ě';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ě';
		$this->assertEqual($result, $expected);

		$string = 'ĝ';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ĝ';
		$this->assertEqual($result, $expected);

		$string = 'ğ';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ğ';
		$this->assertEqual($result, $expected);

		$string = 'ġ';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ġ';
		$this->assertEqual($result, $expected);

		$string = 'ģ';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ģ';
		$this->assertEqual($result, $expected);

		$string = 'ĥ';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ĥ';
		$this->assertEqual($result, $expected);

		$string = 'ħ';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ħ';
		$this->assertEqual($result, $expected);

		$string = 'ĩ';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ĩ';
		$this->assertEqual($result, $expected);

		$string = 'ī';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ī';
		$this->assertEqual($result, $expected);

		$string = 'ĭ';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ĭ';
		$this->assertEqual($result, $expected);

		$string = 'į';
		$result = Multibyte::strtoupper($string);
		$expected = 'Į';
		$this->assertEqual($result, $expected);

		$string = 'ĳ';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ĳ';
		$this->assertEqual($result, $expected);

		$string = 'ĵ';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ĵ';
		$this->assertEqual($result, $expected);

		$string = 'ķ';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ķ';
		$this->assertEqual($result, $expected);

		$string = 'ĺ';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ĺ';
		$this->assertEqual($result, $expected);

		$string = 'ļ';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ļ';
		$this->assertEqual($result, $expected);

		$string = 'ľ';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ľ';
		$this->assertEqual($result, $expected);

		$string = 'ŀ';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ŀ';
		$this->assertEqual($result, $expected);

		$string = 'ł';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ł';
		$this->assertEqual($result, $expected);

		$string = 'ń';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ń';
		$this->assertEqual($result, $expected);

		$string = 'ņ';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ņ';
		$this->assertEqual($result, $expected);

		$string = 'ň';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ň';
		$this->assertEqual($result, $expected);

		$string = 'ŋ';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ŋ';
		$this->assertEqual($result, $expected);

		$string = 'ō';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ō';
		$this->assertEqual($result, $expected);

		$string = 'ŏ';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ŏ';
		$this->assertEqual($result, $expected);

		$string = 'ő';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ő';
		$this->assertEqual($result, $expected);

		$string = 'œ';
		$result = Multibyte::strtoupper($string);
		$expected = 'Œ';
		$this->assertEqual($result, $expected);

		$string = 'ŕ';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ŕ';
		$this->assertEqual($result, $expected);

		$string = 'ŗ';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ŗ';
		$this->assertEqual($result, $expected);

		$string = 'ř';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ř';
		$this->assertEqual($result, $expected);

		$string = 'ś';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ś';
		$this->assertEqual($result, $expected);

		$string = 'ŝ';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ŝ';
		$this->assertEqual($result, $expected);

		$string = 'ş';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ş';
		$this->assertEqual($result, $expected);

		$string = 'š';
		$result = Multibyte::strtoupper($string);
		$expected = 'Š';
		$this->assertEqual($result, $expected);

		$string = 'ţ';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ţ';
		$this->assertEqual($result, $expected);

		$string = 'ť';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ť';
		$this->assertEqual($result, $expected);

		$string = 'ŧ';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ŧ';
		$this->assertEqual($result, $expected);

		$string = 'ũ';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ũ';
		$this->assertEqual($result, $expected);

		$string = 'ū';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ū';
		$this->assertEqual($result, $expected);

		$string = 'ŭ';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ŭ';
		$this->assertEqual($result, $expected);

		$string = 'ů';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ů';
		$this->assertEqual($result, $expected);

		$string = 'ű';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ű';
		$this->assertEqual($result, $expected);

		$string = 'ų';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ų';
		$this->assertEqual($result, $expected);

		$string = 'ŵ';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ŵ';
		$this->assertEqual($result, $expected);

		$string = 'ŷ';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ŷ';
		$this->assertEqual($result, $expected);

		$string = 'ź';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ź';
		$this->assertEqual($result, $expected);

		$string = 'ż';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ż';
		$this->assertEqual($result, $expected);

		$string = 'ž';
		$result = Multibyte::strtoupper($string);
		$expected = 'Ž';
		$this->assertEqual($result, $expected);

		$string = 'āăąćĉċčďđēĕėęěĝğġģĥħĩīĭįĳĵķĺļľŀłńņňŋōŏőœŕŗřśŝşšţťŧũūŭůűųŵŷźżž';
		$result = Multibyte::strtoupper($string);
		$expected = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$result = Multibyte::strtoupper($string);
		$expected = 'ĤĒĹĻŎ, ŴŐŘĻĎ!';
		$this->assertEqual($result, $expected);

		$string = 'ἀι';
		$result = mb_strtoupper($string);
		$expected = 'ἈΙ';
		$this->assertEqual($result, $expected);

		$string = 'ἀι';
		$result = Multibyte::strtoupper($string);
		$expected = 'ἈΙ';
		$this->assertEqual($result, $expected);
	}

	function testUsingMbSubstrCount() {
		$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$find = 'F';
		$result = mb_substr_count($string, $find);
		$expected = 1;
		$this->assertEqual($result, $expected);

		$string = 'ABCDEFGHIJKLMNOPQFRSFTUVWXYZ0F12345F6789';
		$find = 'F';
		$result = mb_substr_count($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÅÊËÌÍÎÏÐÑÒÓÔÅÕÖØÅÙÚÛÅÜÝÞ';
		$find = 'Å';
		$result = mb_substr_count($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÙÚÂÃÄÅÆÇÈÙÚÉÊËÌÍÎÏÐÑÒÓÔÕÖØÅÙÚÛÜÝÞÙÚ';
		$find = 'ÙÚ';
		$result = mb_substr_count($string, $find);
		$expected = 4;
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊÅËÌÍÎÏÐÑÒÓÔÕÅÖØÅÙÚÅÛÜÅÝÞÅ';
		$find = 'Å';
		$result = mb_substr_count($string, $find);
		$expected = 7;
		$this->assertEqual($result, $expected);

		$string = 'ĊĀĂĄĆĈĊČĎĐĒĔĖĊĘĚĜĞĠĢĤĦĨĪĬĮĊĲĴĶĹĻĽĿŁŃŅŇŊŌĊŎŐŒŔŖŘŚŜŞŠŢĊŤŦŨŪŬŮŰĊŲŴŶŹŻŽ';
		$find = 'Ċ';
		$result = mb_substr_count($string, $find);
		$expected = 7;
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĊĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁĊŃŅĊŇŊŌŎŐŒŔŖĊŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$find = 'Ċ';
		$result = mb_substr_count($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = '!"#$%&\'()*+,-./012F34567F89:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghiFjklmnopqFrstuvwFxyz{|}~';
		$find = 'F';
		$result = mb_substr_count($string, $find);
		$expected = 6;
		$this->assertEqual($result, $expected);

		$string = '¡¢£¤¥µ¦§¨©ª«¬­®¯°±²³´µ¶·¸¹º»¼½¾¿ÀÁµÂÃµÄÅÆÇµÈ';
		$find = 'µ';
		$result = mb_substr_count($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôÕÖõö÷øùúûüýþÿĀāĂăĄąĆćĈĉÕÖĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝÕÖĞğĠġĢģĤĥĦÕÖħĨĩĪīĬ';
		$find = 'ÕÖ';
		$result = mb_substr_count($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃńŅņŇňŉŊŋŌōĵĶķĸĹŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšĵĶķĸĹŢţŤťŦŧŨũŪūŬŭŮůŰűŲųĵĶķĸĹŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$find = 'ĵĶķĸĹ';
		$result = mb_substr_count($string, $find);
		$expected = 4;
		$this->assertEqual($result, $expected);

		$string = 'ƑƒƓƔƕƖƸƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊƸǋǌǍǎǏǐǑǒǓƸǔǕǖǗǘǙǚƸǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$find = 'Ƹ';
		$result = mb_substr_count($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƹƠơƢƣƤƥƦƧƨƩƹƪƫƬƭƮƯưƱƲƳƴƹƵƶƷƸƹƺƻƼƽƾƿǀǁǂƹǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$find = 'ƹ';
		$result = mb_substr_count($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'əɚɛɜɝɞʀɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿʀʁʂʃʄʅʆʀʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʀʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʀʻʼ';
		$find = 'ʀ';
		$result = mb_substr_count($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'ЀЁЂЃЄЅІЇЈЉЊЋЌЍЇЎЏАБВГДЕЖЗИЙКЛ';
		$find = 'Ї';
		$result = mb_substr_count($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСРТУФХЦЧШЩЪЫЬРЭЮЯабРвгдежзийклРмнопрстуфхцчшщъыь';
		$find = 'Р';
		$result = mb_substr_count($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСрТУФХЦЧШЩЪЫрЬЭЮЯабвгдежзийклмнопррстуфхцчшщъыь';
		$find = 'р';
		$result = mb_substr_count($string, $find);
		$expected = 4;
		$this->assertEqual($result, $expected);

		$string = 'فنقكلنمنهونىينًٌٍَُ';
		$find = 'ن';
		$result = mb_substr_count($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = '✰✱✲✳✿✴✵✶✷✸✿✹✺✻✼✽✾✿❀❁❂❃❄❅❆✿❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$find = '✿';
		$result = mb_substr_count($string, $find);
		$expected = 4;
		$this->assertEqual($result, $expected);

		$string = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺐⺊⺋⺌⺍⺎⺏⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺐⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⺐⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$find = '⺐';
		$result = mb_substr_count($string, $find);
		$expected = 4;
		$this->assertEqual($result, $expected);

		$string = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽤⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽤⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$find = '⽤';
		$result = mb_substr_count($string, $find);
		$expected = 3;
		$this->assertEqual($result, $expected);

		$string = '눡눢눣눤눥눦눺눻눼눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕눺눻눼뉖뉗뉘뉙뉚뉛뉜뉝눺눻눼뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$find = '눺눻눼';
		$result = mb_substr_count($string, $find);
		$expected = 4;
		$this->assertEqual($result, $expected);

		$string = 'ﺞﺟﺠﺡﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺞﺟﺠﺡﺆﺇﺞﺟﺠﺡﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$find = 'ﺞﺟﺠﺡ';
		$result = mb_substr_count($string, $find);
		$expected = 4;
		$this->assertEqual($result, $expected);

		$string = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﻞﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻞﻕﻖﻗﻘﻙﻚﻛﻜﻝﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻞﻸﻹﻺﻞﻻﻼ';
		$find = 'ﻞ';
		$result = mb_substr_count($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｋｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｋｙｚ';
		$find = 'ｋ';
		$result = mb_substr_count($string, $find);
		$expected = 3;
		$this->assertEqual($result, $expected);

		$string = 'ａｂｋｌｍｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｋｌｍｗｘｙｚ';
		$find = 'ｋｌｍ';
		$result = mb_substr_count($string, $find);
		$expected = 3;
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｐｐｅｆｇｈｉｊｋｌｍｎｏｐｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'ｐｐｅ';
		$result = mb_substr_count($string, $find);
		$expected = 1;
		$this->assertEqual($result, $expected);

		$string = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰｱｲｳｴｵｶｷｸ';
		$find = 'ｱ';
		$result = mb_substr_count($string, $find);
		$expected = 1;
		$this->assertEqual($result, $expected);

		$string = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$find = 'ﾊ';
		$result = mb_substr_count($string, $find);
		$expected = 1;
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'ő';
		$result = mb_substr_count($string, $find);
		$expected = 1;
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'ĺļ';
		$result = mb_substr_count($string, $find);
		$expected = 1;
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'o';
		$result = mb_substr_count($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'rl';
		$result = mb_substr_count($string, $find);
		$expected = 1;
		$this->assertEqual($result, $expected);

		$string = 'čini';
		$find = 'n';
		$result = mb_substr_count($string, $find);
		$expected = 1;
		$this->assertEqual($result, $expected);

		$string = 'ničiničiini';
		$find = 'n';
		$result = mb_substr_count($string, $find);
		$expected = 3;
		$this->assertEqual($result, $expected);

		$string = 'moći';
		$find = 'ć';
		$result = mb_substr_count($string, $find);
		$expected = 1;
		$this->assertEqual($result, $expected);

		$string = 'moćimoćimoćmćioći';
		$find = 'ći';
		$result = mb_substr_count($string, $find);
		$expected = 4;
		$this->assertEqual($result, $expected);

		$string = 'državni';
		$find = 'ž';
		$result = mb_substr_count($string, $find);
		$expected = 1;
		$this->assertEqual($result, $expected);

		$string = '把百度设为首页';
		$find = '设';
		$result = mb_substr_count($string, $find);
		$expected = 1;
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$find = '周';
		$result = mb_substr_count($string, $find);
		$expected = 1;
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'H';
		$result = mb_substr_count($string, $find);
		$expected = false;
		$this->assertEqual($result, $expected);
	}

	function testMultibyteSubstrCount() {
		$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$find = 'F';
		$result = Multibyte::substrCount($string, $find);
		$expected = 1;
		$this->assertEqual($result, $expected);

		$string = 'ABCDEFGHIJKLMNOPQFRSFTUVWXYZ0F12345F6789';
		$find = 'F';
		$result = Multibyte::substrCount($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÅÊËÌÍÎÏÐÑÒÓÔÅÕÖØÅÙÚÛÅÜÝÞ';
		$find = 'Å';
		$result = Multibyte::substrCount($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÙÚÂÃÄÅÆÇÈÙÚÉÊËÌÍÎÏÐÑÒÓÔÕÖØÅÙÚÛÜÝÞÙÚ';
		$find = 'ÙÚ';
		$result = Multibyte::substrCount($string, $find);
		$expected = 4;
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊÅËÌÍÎÏÐÑÒÓÔÕÅÖØÅÙÚÅÛÜÅÝÞÅ';
		$find = 'Å';
		$result = Multibyte::substrCount($string, $find);
		$expected = 7;
		$this->assertEqual($result, $expected);

		$string = 'ĊĀĂĄĆĈĊČĎĐĒĔĖĊĘĚĜĞĠĢĤĦĨĪĬĮĊĲĴĶĹĻĽĿŁŃŅŇŊŌĊŎŐŒŔŖŘŚŜŞŠŢĊŤŦŨŪŬŮŰĊŲŴŶŹŻŽ';
		$find = 'Ċ';
		$result = Multibyte::substrCount($string, $find);
		$expected = 7;
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĊĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁĊŃŅĊŇŊŌŎŐŒŔŖĊŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$find = 'Ċ';
		$result = Multibyte::substrCount($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = '!"#$%&\'()*+,-./012F34567F89:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghiFjklmnopqFrstuvwFxyz{|}~';
		$find = 'F';
		$result = Multibyte::substrCount($string, $find);
		$expected = 6;
		$this->assertEqual($result, $expected);

		$string = '¡¢£¤¥µ¦§¨©ª«¬­®¯°±²³´µ¶·¸¹º»¼½¾¿ÀÁµÂÃµÄÅÆÇµÈ';
		$find = 'µ';
		$result = Multibyte::substrCount($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôÕÖõö÷øùúûüýþÿĀāĂăĄąĆćĈĉÕÖĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝÕÖĞğĠġĢģĤĥĦÕÖħĨĩĪīĬ';
		$find = 'ÕÖ';
		$result = Multibyte::substrCount($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃńŅņŇňŉŊŋŌōĵĶķĸĹŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšĵĶķĸĹŢţŤťŦŧŨũŪūŬŭŮůŰűŲųĵĶķĸĹŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$find = 'ĵĶķĸĹ';
		$result = Multibyte::substrCount($string, $find);
		$expected = 4;
		$this->assertEqual($result, $expected);

		$string = 'ƑƒƓƔƕƖƸƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊƸǋǌǍǎǏǐǑǒǓƸǔǕǖǗǘǙǚƸǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$find = 'Ƹ';
		$result = Multibyte::substrCount($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƹƠơƢƣƤƥƦƧƨƩƹƪƫƬƭƮƯưƱƲƳƴƹƵƶƷƸƹƺƻƼƽƾƿǀǁǂƹǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$find = 'ƹ';
		$result = Multibyte::substrCount($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'əɚɛɜɝɞʀɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿʀʁʂʃʄʅʆʀʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʀʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʀʻʼ';
		$find = 'ʀ';
		$result = Multibyte::substrCount($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'ЀЁЂЃЄЅІЇЈЉЊЋЌЍЇЎЏАБВГДЕЖЗИЙКЛ';
		$find = 'Ї';
		$result = Multibyte::substrCount($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСРТУФХЦЧШЩЪЫЬРЭЮЯабРвгдежзийклРмнопрстуфхцчшщъыь';
		$find = 'Р';
		$result = Multibyte::substrCount($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСрТУФХЦЧШЩЪЫрЬЭЮЯабвгдежзийклмнопррстуфхцчшщъыь';
		$find = 'р';
		$result = Multibyte::substrCount($string, $find);
		$expected = 4;
		$this->assertEqual($result, $expected);

		$string = 'فنقكلنمنهونىينًٌٍَُ';
		$find = 'ن';
		$result = Multibyte::substrCount($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = '✰✱✲✳✿✴✵✶✷✸✿✹✺✻✼✽✾✿❀❁❂❃❄❅❆✿❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$find = '✿';
		$result = Multibyte::substrCount($string, $find);
		$expected = 4;
		$this->assertEqual($result, $expected);

		$string = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺐⺊⺋⺌⺍⺎⺏⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺐⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⺐⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$find = '⺐';
		$result = Multibyte::substrCount($string, $find);
		$expected = 4;
		$this->assertEqual($result, $expected);

		$string = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽤⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽤⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$find = '⽤';
		$result = Multibyte::substrCount($string, $find);
		$expected = 3;
		$this->assertEqual($result, $expected);

		$string = '눡눢눣눤눥눦눺눻눼눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕눺눻눼뉖뉗뉘뉙뉚뉛뉜뉝눺눻눼뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$find = '눺눻눼';
		$result = Multibyte::substrCount($string, $find);
		$expected = 4;
		$this->assertEqual($result, $expected);

		$string = 'ﺞﺟﺠﺡﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺞﺟﺠﺡﺆﺇﺞﺟﺠﺡﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$find = 'ﺞﺟﺠﺡ';
		$result = Multibyte::substrCount($string, $find);
		$expected = 4;
		$this->assertEqual($result, $expected);

		$string = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﻞﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻞﻕﻖﻗﻘﻙﻚﻛﻜﻝﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻞﻸﻹﻺﻞﻻﻼ';
		$find = 'ﻞ';
		$result = Multibyte::substrCount($string, $find);
		$expected = 5;
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｋｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｋｙｚ';
		$find = 'ｋ';
		$result = Multibyte::substrCount($string, $find);
		$expected = 3;
		$this->assertEqual($result, $expected);

		$string = 'ａｂｋｌｍｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｋｌｍｗｘｙｚ';
		$find = 'ｋｌｍ';
		$result = Multibyte::substrCount($string, $find);
		$expected = 3;
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｐｐｅｆｇｈｉｊｋｌｍｎｏｐｐｑｒｓｔｕｖｗｘｙｚ';
		$find = 'ｐｐｅ';
		$result = Multibyte::substrCount($string, $find);
		$expected = 1;
		$this->assertEqual($result, $expected);

		$string = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰｱｲｳｴｵｶｷｸ';
		$find = 'ｱ';
		$result = Multibyte::substrCount($string, $find);
		$expected = 1;
		$this->assertEqual($result, $expected);

		$string = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$find = 'ﾊ';
		$result = Multibyte::substrCount($string, $find);
		$expected = 1;
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'ő';
		$result = Multibyte::substrCount($string, $find);
		$expected = 1;
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'ĺļ';
		$result = Multibyte::substrCount($string, $find);
		$expected = 1;
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'o';
		$result = Multibyte::substrCount($string, $find);
		$expected = 2;
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$find = 'rl';
		$result = Multibyte::substrCount($string, $find);
		$expected = 1;
		$this->assertEqual($result, $expected);

		$string = 'čini';
		$find = 'n';
		$result = Multibyte::substrCount($string, $find);
		$expected = 1;
		$this->assertEqual($result, $expected);

		$string = 'ničiničiini';
		$find = 'n';
		$result = Multibyte::substrCount($string, $find);
		$expected = 3;
		$this->assertEqual($result, $expected);

		$string = 'moći';
		$find = 'ć';
		$result = Multibyte::substrCount($string, $find);
		$expected = 1;
		$this->assertEqual($result, $expected);

		$string = 'moćimoćimoćmćioći';
		$find = 'ći';
		$result = Multibyte::substrCount($string, $find);
		$expected = 4;
		$this->assertEqual($result, $expected);

		$string = 'državni';
		$find = 'ž';
		$result = Multibyte::substrCount($string, $find);
		$expected = 1;
		$this->assertEqual($result, $expected);

		$string = '把百度设为首页';
		$find = '设';
		$result = Multibyte::substrCount($string, $find);
		$expected = 1;
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$find = '周';
		$result = Multibyte::substrCount($string, $find);
		$expected = 1;
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$find = 'H';
		$result = Multibyte::substrCount($string, $find);
		$expected = false;
		$this->assertEqual($result, $expected);
	}

	function testUsingMbSubstr() {
		$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$result = mb_substr($string, 4, 7);
		$expected = 'EFGHIJK';
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$result = mb_substr($string, 4, 7);
		$expected = 'ÄÅÆÇÈÉÊ';
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$find = 'Ċ';
		$result = mb_substr($string, 4, 7);
		$expected = 'ĈĊČĎĐĒĔ';
		$this->assertEqual($result, $expected);

		$string = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$result = mb_substr($string, 4, 7);
		$expected = '%&\'()*+';
		$this->assertEqual($result, $expected);

		$string = '¡¢£¤¥¦§¨©ª«¬­®¯°±²³´µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$result = mb_substr($string, 4);
		$expected = '¥¦§¨©ª«¬­®¯°±²³´µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$this->assertEqual($result, $expected);

		$string = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬ';
		$result = mb_substr($string, 4, 7);
		$expected = 'ÍÎÏÐÑÒÓ';
		$this->assertEqual($result, $expected);

		$string = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃńŅņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$result = mb_substr($string, 4, 7);
		$expected = 'ıĲĳĴĵĶķ';
		$this->assertEqual($result, $expected);

		$string = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$result = mb_substr($string, 25);
		$expected = 'ƪƫƬƭƮƯưƱƲƳƴƵƶƷƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$this->assertEqual($result, $expected);

		$string = 'əɚɛɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$result = mb_substr($string, 3);
		$expected = 'ɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$this->assertEqual($result, $expected);

		$string = 'ЀЁЂЃЄЅІЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$result = mb_substr($string, 3);
		$expected = 'ЃЄЅІЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$result = mb_substr($string, 3, 16);
		$expected = 'ПРСТУФХЦЧШЩЪЫЬЭЮ';
		$this->assertEqual($result, $expected);

		$string = 'فقكلمنهوىيًٌٍَُ';
		$result = mb_substr($string, 3, 6);
		$expected = 'لمنهوى';
		$this->assertEqual($result, $expected);

		$string = '✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾✿❀❁❂❃❄❅❆❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$result = mb_substr($string, 6, 14);
		$expected = '✶✷✸✹✺✻✼✽✾✿❀❁❂❃';
		$this->assertEqual($result, $expected);

		$string = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺊⺋⺌⺍⺎⺏⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$result = mb_substr($string, 8, 13);
		$expected = '⺈⺉⺊⺋⺌⺍⺎⺏⺐⺑⺒⺓⺔';
		$this->assertEqual($result, $expected);

		$string = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$result = mb_substr($string, 12, 24);
		$expected = '⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣⽤⽥⽦⽧⽨';
		$this->assertEqual($result, $expected);

		$string = '눡눢눣눤눥눦눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕뉖뉗뉘뉙뉚뉛뉜뉝뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$result = mb_substr($string, 12, 24);
		$expected = '눭눮눯눰눱눲눳눴눵눶눷눸눹눺눻눼눽눾눿뉀뉁뉂뉃뉄';
		$this->assertEqual($result, $expected);

		$string = 'ﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$result = mb_substr($string, 12);
		$expected = 'ﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$this->assertEqual($result, $expected);

		$string = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻕﻖﻗﻘﻙﻚﻛﻜﻝﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻸﻹﻺﻻﻼ';
		$result = mb_substr($string, 24, 12);
		$expected = 'ﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔ';
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$result = mb_substr($string, 11, 2);
		$expected = 'ｌｍ';
		$this->assertEqual($result, $expected);

		$string = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰｱｲｳｴｵｶｷｸ';
		$result = mb_substr($string, 7, 11);
		$expected = 'ｨｩｪｫｬｭｮｯｰｱｲ';
		$this->assertEqual($result, $expected);

		$string = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$result = mb_substr($string, 13, 13);
		$expected = 'ﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒ';
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$result = mb_substr($string, 3, 4);
		$expected = 'ļŏ, ';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$result = mb_substr($string, 3, 4);
		$expected = 'lo, ';
		$this->assertEqual($result, $expected);

		$string = 'čini';
		$result = mb_substr($string, 3);
		$expected = 'i';
		$this->assertEqual($result, $expected);

		$string = 'moći';
		$result = mb_substr($string, 1);
		$expected = 'oći';
		$this->assertEqual($result, $expected);

		$string = 'državni';
		$result = mb_substr($string, 0, 2);
		$expected = 'dr';
		$this->assertEqual($result, $expected);

		$string = '把百度设为首页';
		$result = mb_substr($string, 3, 3);
		$expected = '设为首';
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$result = mb_substr($string, 0, 1);
		$expected = '一';
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$result = mb_substr($string, 6);
		$expected = false;
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$result = mb_substr($string, 0);
		$expected = '一二三周永龍';
		$this->assertEqual($result, $expected);
	}

	function testMultibyteSubstr() {
		$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$result = Multibyte::substr($string, 4, 7);
		$expected = 'EFGHIJK';
		$this->assertEqual($result, $expected);

		$string = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ';
		$result = Multibyte::substr($string, 4, 7);
		$expected = 'ÄÅÆÇÈÉÊ';
		$this->assertEqual($result, $expected);

		$string = 'ĀĂĄĆĈĊČĎĐĒĔĖĘĚĜĞĠĢĤĦĨĪĬĮĲĴĶĹĻĽĿŁŃŅŇŊŌŎŐŒŔŖŘŚŜŞŠŢŤŦŨŪŬŮŰŲŴŶŹŻŽ';
		$find = 'Ċ';
		$result = Multibyte::substr($string, 4, 7);
		$expected = 'ĈĊČĎĐĒĔ';
		$this->assertEqual($result, $expected);

		$string = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
		$result = Multibyte::substr($string, 4, 7);
		$expected = '%&\'()*+';
		$this->assertEqual($result, $expected);

		$string = '¡¢£¤¥¦§¨©ª«¬­®¯°±²³´µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$result = Multibyte::substr($string, 4);
		$expected = '¥¦§¨©ª«¬­®¯°±²³´µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈ';
		$this->assertEqual($result, $expected);

		$string = 'ÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬ';
		$result = Multibyte::substr($string, 4, 7);
		$expected = 'ÍÎÏÐÑÒÓ';
		$this->assertEqual($result, $expected);

		$string = 'ĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃńŅņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſƀƁƂƃƄƅƆƇƈƉƊƋƌƍƎƏƐ';
		$result = Multibyte::substr($string, 4, 7);
		$expected = 'ıĲĳĴĵĶķ';
		$this->assertEqual($result, $expected);

		$string = 'ƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$result = Multibyte::substr($string, 25);
		$expected = 'ƪƫƬƭƮƯưƱƲƳƴƵƶƷƸƹƺƻƼƽƾƿǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴ';
		$this->assertEqual($result, $expected);

		$string = 'əɚɛɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$result = Multibyte::substr($string, 3);
		$expected = 'ɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼ';
		$this->assertEqual($result, $expected);

		$string = 'ЀЁЂЃЄЅІЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$result = Multibyte::substr($string, 3);
		$expected = 'ЃЄЅІЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛ';
		$this->assertEqual($result, $expected);

		$string = 'МНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыь';
		$result = Multibyte::substr($string, 3, 16);
		$expected = 'ПРСТУФХЦЧШЩЪЫЬЭЮ';
		$this->assertEqual($result, $expected);

		$string = 'فقكلمنهوىيًٌٍَُ';
		$result = Multibyte::substr($string, 3, 6);
		$expected = 'لمنهوى';
		$this->assertEqual($result, $expected);

		$string = '✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾✿❀❁❂❃❄❅❆❇❈❉❊❋❌❍❎❏❐❑❒❓❔❕❖❗❘❙❚❛❜❝❞';
		$result = Multibyte::substr($string, 6, 14);
		$expected = '✶✷✸✹✺✻✼✽✾✿❀❁❂❃';
		$this->assertEqual($result, $expected);

		$string = '⺀⺁⺂⺃⺄⺅⺆⺇⺈⺉⺊⺋⺌⺍⺎⺏⺐⺑⺒⺓⺔⺕⺖⺗⺘⺙⺛⺜⺝⺞⺟⺠⺡⺢⺣⺤⺥⺦⺧⺨⺩⺪⺫⺬⺭⺮⺯⺰⺱⺲⺳⺴⺵⺶⺷⺸⺹⺺⺻⺼⺽⺾⺿⻀⻁⻂⻃⻄⻅⻆⻇⻈⻉⻊⻋⻌⻍⻎⻏⻐⻑⻒⻓⻔⻕⻖⻗⻘⻙⻚⻛⻜⻝⻞⻟⻠';
		$result = Multibyte::substr($string, 8, 13);
		$expected = '⺈⺉⺊⺋⺌⺍⺎⺏⺐⺑⺒⺓⺔';
		$this->assertEqual($result, $expected);

		$string = '⽅⽆⽇⽈⽉⽊⽋⽌⽍⽎⽏⽐⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣⽤⽥⽦⽧⽨⽩⽪⽫⽬⽭⽮⽯⽰⽱⽲⽳⽴⽵⽶⽷⽸⽹⽺⽻⽼⽽⽾⽿';
		$result = Multibyte::substr($string, 12, 24);
		$expected = '⽑⽒⽓⽔⽕⽖⽗⽘⽙⽚⽛⽜⽝⽞⽟⽠⽡⽢⽣⽤⽥⽦⽧⽨';
		$this->assertEqual($result, $expected);

		$string = '눡눢눣눤눥눦눧눨눩눪눫눬눭눮눯눰눱눲눳눴눵눶눷눸눹눺눻눼눽눾눿뉀뉁뉂뉃뉄뉅뉆뉇뉈뉉뉊뉋뉌뉍뉎뉏뉐뉑뉒뉓뉔뉕뉖뉗뉘뉙뉚뉛뉜뉝뉞뉟뉠뉡뉢뉣뉤뉥뉦뉧뉨뉩뉪뉫뉬뉭뉮뉯뉰뉱뉲뉳뉴뉵뉶뉷뉸뉹뉺뉻뉼뉽뉾뉿늀늁늂늃늄';
		$result = Multibyte::substr($string, 12, 24);
		$expected = '눭눮눯눰눱눲눳눴눵눶눷눸눹눺눻눼눽눾눿뉀뉁뉂뉃뉄';
		$this->assertEqual($result, $expected);

		$string = 'ﹰﹱﹲﹳﹴ﹵ﹶﹷﹸﹹﹺﹻﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$result = Multibyte::substr($string, 12);
		$expected = 'ﹼﹽﹾﹿﺀﺁﺂﺃﺄﺅﺆﺇﺈﺉﺊﺋﺌﺍﺎﺏﺐﺑﺒﺓﺔﺕﺖﺗﺘﺙﺚﺛﺜﺝﺞﺟﺠﺡﺢﺣﺤﺥﺦﺧﺨﺩﺪﺫﺬﺭﺮﺯﺰ';
		$this->assertEqual($result, $expected);

		$string = 'ﺱﺲﺳﺴﺵﺶﺷﺸﺹﺺﺻﺼﺽﺾﺿﻀﻁﻂﻃﻄﻅﻆﻇﻈﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔﻕﻖﻗﻘﻙﻚﻛﻜﻝﻞﻟﻠﻡﻢﻣﻤﻥﻦﻧﻨﻩﻪﻫﻬﻭﻮﻯﻰﻱﻲﻳﻴﻵﻶﻷﻸﻹﻺﻻﻼ';
		$result = Multibyte::substr($string, 24, 12);
		$expected = 'ﻉﻊﻋﻌﻍﻎﻏﻐﻑﻒﻓﻔ';
		$this->assertEqual($result, $expected);

		$string = 'ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ';
		$result = Multibyte::substr($string, 11, 2);
		$expected = 'ｌｍ';
		$this->assertEqual($result, $expected);

		$string = '｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｰｱｲｳｴｵｶｷｸ';
		$result = Multibyte::substr($string, 7, 11);
		$expected = 'ｨｩｪｫｬｭｮｯｰｱｲ';
		$this->assertEqual($result, $expected);

		$string = 'ｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞ';
		$result = Multibyte::substr($string, 13, 13);
		$expected = 'ﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒ';
		$this->assertEqual($result, $expected);

		$string = 'Ĥēĺļŏ, Ŵőřļď!';
		$result = Multibyte::substr($string, 3, 4);
		$expected = 'ļŏ, ';
		$this->assertEqual($result, $expected);

		$string = 'Hello, World!';
		$result = Multibyte::substr($string, 3, 4);
		$expected = 'lo, ';
		$this->assertEqual($result, $expected);

		$string = 'čini';
		$result = Multibyte::substr($string, 3);
		$expected = 'i';
		$this->assertEqual($result, $expected);

		$string = 'moći';
		$result = Multibyte::substr($string, 1);
		$expected = 'oći';
		$this->assertEqual($result, $expected);

		$string = 'državni';
		$result = Multibyte::substr($string, 0, 2);
		$expected = 'dr';
		$this->assertEqual($result, $expected);

		$string = '把百度设为首页';
		$result = Multibyte::substr($string, 3, 3);
		$expected = '设为首';
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$result = Multibyte::substr($string, 0, 1);
		$expected = '一';
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$result = Multibyte::substr($string, 6);
		$expected = false;
		$this->assertEqual($result, $expected);

		$string = '一二三周永龍';
		$result = Multibyte::substr($string, 0);
		$expected = '一二三周永龍';
		$this->assertEqual($result, $expected);
	}
}
?>