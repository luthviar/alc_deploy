var _$_cc5c=["INPUT","TEXTAREA","DIV","SPAN","getElementById","","id","contentWindow","innerHTML","body","document","length","getElementsByTagName","type","text","isContentEditable","showModalDialog","?","indexOf","?Modal=true","&Modal=true","dialogHeight:340px; dialogWidth:395px; edge:Raised; center:Yes; help:No; resizable:Yes; status:No; scroll:No","newWindow","height=300,width=400,scrollbars=no,resizable=no,toolbars=no,status=no,menubar=no,location=no","open","value","ElementIndex","dialogArguments","window","opener","SpellMode","start","suggest","end","submit","SpellingForm","checkElements","getText","innerText","StatusText","Spell Checking Text ...","CurrentText","WordIndex","setText","Spell Check Complete","close","selectedIndex","ReplacementWord","form","options"];var showCompleteAlert=true;var tagGroup= new Array(_$_cc5c[0],_$_cc5c[1],_$_cc5c[2],_$_cc5c[3]);var checkElements= new Array();function getText(_0x55CF){var _0xA327=document[_$_cc5c[4]](checkElements[_0x55CF]);var _0x3739C=_$_cc5c[5];var _0x37339=document[_$_cc5c[4]](_0xA327[_$_cc5c[6]]);if(_0x37339[_$_cc5c[7]]){_0x3739C= _0x37339[_$_cc5c[7]][_$_cc5c[10]][_$_cc5c[9]][_$_cc5c[8]]}else {_0x3739C= _0x37339[_$_cc5c[10]][_$_cc5c[9]][_$_cc5c[8]]};return _0x3739C}function setText(_0x55CF,_0x5821){var _0xA327=document[_$_cc5c[4]](checkElements[_0x55CF]);var _0x37339=document[_$_cc5c[4]](_0xA327[_$_cc5c[6]]);if(_0x37339[_$_cc5c[7]]){_0x37339[_$_cc5c[7]][_$_cc5c[10]][_$_cc5c[9]][_$_cc5c[8]]= _0x5821}else {_0x37339[_$_cc5c[10]][_$_cc5c[9]][_$_cc5c[8]]= _0x5821}}function checkSpelling(){checkElements=  new Array();for(var i=0;i< tagGroup[_$_cc5c[11]];i++){var _0xA5DC=tagGroup[i];var _0xA579=document[_$_cc5c[12]](_0xA5DC);for(var _0xA63F=0;_0xA63F< _0xA579[_$_cc5c[11]];_0xA63F++){if((_0xA5DC== _$_cc5c[0]&& _0xA579[_0xA63F][_$_cc5c[13]]== _$_cc5c[14])|| _0xA5DC== _$_cc5c[1]){checkElements[checkElements[_$_cc5c[11]]]= _0xA579[_0xA63F][_$_cc5c[6]]}else {if((_0xA5DC== _$_cc5c[2]|| _0xA5DC== _$_cc5c[3])&& _0xA579[_0xA63F][_$_cc5c[15]]){checkElements[checkElements[_$_cc5c[11]]]= _0xA579[_0xA63F][_$_cc5c[6]]}}}};openSpellChecker()}function checkSpellingById(_0xA6A2,_0xA705){checkElements=  new Array();checkElements[checkElements[_$_cc5c[11]]]= _0xA6A2;openSpellChecker(_0xA705)}function checkElementSpelling(_0xA327){checkElements=  new Array();checkElements[checkElements[_$_cc5c[11]]]= _0xA327[_$_cc5c[6]];openSpellChecker()}function openSpellChecker(_0xA705){if(window[_$_cc5c[16]]){var _0x255D3;if(_0xA705[_$_cc5c[18]](_$_cc5c[17])==  -1){_0x255D3= _$_cc5c[19]}else {_0x255D3= _$_cc5c[20]};var _0x660D=window[_$_cc5c[16]](_0xA705+ _0x255D3,window,_$_cc5c[21])}else {var _0x37CE4=window[_$_cc5c[24]](_0xA705,_$_cc5c[22],_$_cc5c[23])}}var iElementIndex=-1;var parentWindow;function initialize(){iElementIndex= parseInt(document[_$_cc5c[4]](_$_cc5c[26])[_$_cc5c[25]]);if(parent[_$_cc5c[28]][_$_cc5c[27]]){parentWindow= parent[_$_cc5c[28]][_$_cc5c[27]]}else {if(top[_$_cc5c[29]]){parentWindow= top[_$_cc5c[29]]}};var _0x379CC=document[_$_cc5c[4]](_$_cc5c[30])[_$_cc5c[25]];switch(_0x379CC){case _$_cc5c[31]:break;case _$_cc5c[32]:updateText();break;case _$_cc5c[33]:updateText();default:if(loadText()){document[_$_cc5c[4]](_$_cc5c[35])[_$_cc5c[34]]()}else {endCheck()};break}}function loadText(){if(!parentWindow[_$_cc5c[10]]){return false};for(++iElementIndex;iElementIndex< parentWindow[_$_cc5c[36]][_$_cc5c[11]];iElementIndex++){var _0x7FF6=parentWindow[_$_cc5c[37]](iElementIndex);if(_0x7FF6[_$_cc5c[11]]> 0){updateSettings(_0x7FF6,0,iElementIndex,_$_cc5c[31]);document[_$_cc5c[4]](_$_cc5c[39])[_$_cc5c[38]]= _$_cc5c[40];return true}};return false}function updateSettings(_0x3AE01,_0x7A8C,_0x3AE64,_0xA8F4){document[_$_cc5c[4]](_$_cc5c[41])[_$_cc5c[25]]= _0x3AE01;document[_$_cc5c[4]](_$_cc5c[42])[_$_cc5c[25]]= _0x7A8C;document[_$_cc5c[4]](_$_cc5c[26])[_$_cc5c[25]]= _0x3AE64;document[_$_cc5c[4]](_$_cc5c[30])[_$_cc5c[25]]= _0xA8F4}function updateText(){if(!parentWindow[_$_cc5c[10]]){return false};var _0x7FF6=document[_$_cc5c[4]](_$_cc5c[41])[_$_cc5c[25]];parentWindow[_$_cc5c[43]](iElementIndex,_0x7FF6)}function endCheck(){if(showCompleteAlert){alert(_$_cc5c[44])};closeWindow()}function closeWindow(){top[_$_cc5c[45]]()}function changeWord(_0xA327){var _0xA2C4=_0xA327[_$_cc5c[46]];_0xA327[_$_cc5c[48]][_$_cc5c[47]][_$_cc5c[25]]= _0xA327[_$_cc5c[49]][_0xA2C4][_$_cc5c[25]]}