var _$_22b8=["getTime","SetStyle","toLowerCase","length","","GetStyle","GetText",":",";","split","replace","cssText","sel_font","div_font_detail","sel_fontfamily","cb_decoration_under","cb_decoration_over","cb_decoration_through","cb_style_bold","cb_style_italic","sel_fontTransform","sel_fontsize","inp_fontsize","sel_fontsize_unit","inp_color","inp_color_Preview","outer","div_demo","disabled","selectedIndex","style","value","font","fontFamily","color","backgroundColor","textDecoration","checked","overline","indexOf","underline","line-through","fontWeight","bold","fontStyle","italic","fontSize","options","textTransform","font-family","overline ","underline ","line-through ","substr","onclick"];function pause(_0x37DAA){var _0x35131= new Date();var _0x37D47=_0x35131[_$_22b8[0]]()+ _0x37DAA;while(true){_0x35131=  new Date();if(_0x35131[_$_22b8[0]]()> _0x37D47){return}}}function StyleClass(_0x5821){var _0x39793=[];var _0x224B6={};if(_0x5821){_0x397F6()};this[_$_22b8[1]]= function SetStyle(name,_0x5B39,_0x39859){name= name[_$_22b8[2]]();for(var i=0;i< _0x39793[_$_22b8[3]];i++){if(_0x39793[i]== name){break}};_0x39793[i]= name;_0x224B6[name]= _0x5B39?(_0x5B39+ (_0x39859|| _$_22b8[4])):_$_22b8[4]};this[_$_22b8[5]]= function GetStyle(name){name= name[_$_22b8[2]]();return _0x224B6[name]|| _$_22b8[4]};this[_$_22b8[6]]= function _0x39730(){var _0x5821=_$_22b8[4];for(var i=0;i< _0x39793[_$_22b8[3]];i++){var _0x6358=_0x39793[i];var p=_0x224B6[_0x6358];if(p){_0x5821+= _0x6358+ _$_22b8[7]+ p+ _$_22b8[8]}};return _0x5821};function _0x397F6(){var arr=_0x5821[_$_22b8[9]](_$_22b8[8]);for(var i=0;i< arr[_$_22b8[3]];i++){var p=arr[i][_$_22b8[9]](_$_22b8[7]);var _0x6358=p[0][_$_22b8[10]](/^\s+/g,_$_22b8[4])[_$_22b8[10]](/\s+$/g,_$_22b8[4])[_$_22b8[2]]();_0x39793[_0x39793[_$_22b8[3]]]= _0x6358;_0x224B6[_0x6358]= p[1]}}}function GetStyle(_0xD8E8,name){return  new StyleClass(_0xD8E8[_$_22b8[11]])[_$_22b8[5]](name)}function SetStyle(_0xD8E8,name,_0x5B39,_0x38D22){var _0x37F36= new StyleClass(_0xD8E8[_$_22b8[11]]);_0x37F36[_$_22b8[1]](name,_0x5B39,_0x38D22);_0xD8E8[_$_22b8[11]]= _0x37F36[_$_22b8[6]]()}function ParseFloatToString(_0x5C62){var _0xA4B3=parseFloat(_0x5C62);if(isNaN(_0xA4B3)){return _$_22b8[4]};return _0xA4B3+ _$_22b8[4]}var sel_font=Window_GetElement(window,_$_22b8[12],true);var div_font_detail=Window_GetElement(window,_$_22b8[13],true);var sel_fontfamily=Window_GetElement(window,_$_22b8[14],true);var cb_decoration_under=Window_GetElement(window,_$_22b8[15],true);var cb_decoration_over=Window_GetElement(window,_$_22b8[16],true);var cb_decoration_through=Window_GetElement(window,_$_22b8[17],true);var cb_style_bold=Window_GetElement(window,_$_22b8[18],true);var cb_style_italic=Window_GetElement(window,_$_22b8[19],true);var sel_fontTransform=Window_GetElement(window,_$_22b8[20],true);var sel_fontsize=Window_GetElement(window,_$_22b8[21],true);var inp_fontsize=Window_GetElement(window,_$_22b8[22],true);var sel_fontsize_unit=Window_GetElement(window,_$_22b8[23],true);var inp_color=Window_GetElement(window,_$_22b8[24],true);var inp_color_Preview=Window_GetElement(window,_$_22b8[25],true);var outer=Window_GetElement(window,_$_22b8[26],true);var div_demo=Window_GetElement(window,_$_22b8[27],true);UpdateState= function UpdateState_Font(){inp_fontsize[_$_22b8[28]]= sel_fontsize_unit[_$_22b8[28]]= (sel_fontsize[_$_22b8[29]]> 0);div_font_detail[_$_22b8[28]]= sel_font[_$_22b8[29]]> 0;div_demo[_$_22b8[30]][_$_22b8[11]]= element[_$_22b8[30]][_$_22b8[11]]};SyncToView= function SyncToView_Font(){sel_font[_$_22b8[31]]= element[_$_22b8[30]][_$_22b8[32]][_$_22b8[2]]()|| null;sel_fontfamily[_$_22b8[31]]= element[_$_22b8[30]][_$_22b8[33]];inp_color[_$_22b8[31]]= element[_$_22b8[30]][_$_22b8[34]];inp_color[_$_22b8[30]][_$_22b8[35]]= inp_color[_$_22b8[31]];var _0x1B8D1=element[_$_22b8[30]][_$_22b8[36]][_$_22b8[2]]();cb_decoration_over[_$_22b8[37]]= _0x1B8D1[_$_22b8[39]](_$_22b8[38])!=  -1;cb_decoration_under[_$_22b8[37]]= _0x1B8D1[_$_22b8[39]](_$_22b8[40])!=  -1;cb_decoration_through[_$_22b8[37]]= _0x1B8D1[_$_22b8[39]](_$_22b8[41])!=  -1;cb_style_bold[_$_22b8[37]]= element[_$_22b8[30]][_$_22b8[42]]== _$_22b8[43];cb_style_italic[_$_22b8[37]]= element[_$_22b8[30]][_$_22b8[44]]== _$_22b8[45];sel_fontsize[_$_22b8[31]]= element[_$_22b8[30]][_$_22b8[46]];sel_fontsize_unit[_$_22b8[29]]= 0;if(sel_fontsize[_$_22b8[29]]==  -1){if(ParseFloatToString(element[_$_22b8[30]][_$_22b8[46]])){sel_fontsize[_$_22b8[31]]= ParseFloatToString(element[_$_22b8[30]][_$_22b8[46]]);for(var i=0;i< sel_fontsize_unit[_$_22b8[47]][_$_22b8[3]];i++){var _0xA261=sel_fontsize_unit[_$_22b8[47]](i)[_$_22b8[31]];if(_0xA261&& element[_$_22b8[30]][_$_22b8[46]][_$_22b8[39]](_0xA261)!=  -1){sel_fontsize_unit[_$_22b8[29]]= i;break}}}};sel_fontTransform[_$_22b8[31]]= element[_$_22b8[30]][_$_22b8[48]]};SyncTo= function SyncTo_Font(element){SetStyle(element[_$_22b8[30]],_$_22b8[32],sel_font[_$_22b8[31]]);if(sel_fontfamily[_$_22b8[31]]){element[_$_22b8[30]][_$_22b8[33]]= sel_fontfamily[_$_22b8[31]]}else {SetStyle(element[_$_22b8[30]],_$_22b8[49],_$_22b8[4])};try{element[_$_22b8[30]][_$_22b8[34]]= inp_color[_$_22b8[31]]|| _$_22b8[4]}catch(x){element[_$_22b8[30]][_$_22b8[34]]= _$_22b8[4]};var _0x39982=cb_decoration_over[_$_22b8[37]];var _0x399E5=cb_decoration_under[_$_22b8[37]];var _0x39A48=cb_decoration_through[_$_22b8[37]];if(!_0x39982&&  !_0x399E5 &&  !_0x39A48){element[_$_22b8[30]][_$_22b8[36]]= _$_22b8[4]}else {var _0xD94B=_$_22b8[4];if(_0x39982){_0xD94B+= _$_22b8[50]};if(_0x399E5){_0xD94B+= _$_22b8[51]};if(_0x39A48){_0xD94B+= _$_22b8[52]};element[_$_22b8[30]][_$_22b8[36]]= _0xD94B[_$_22b8[53]](0,_0xD94B[_$_22b8[3]]- 1)};element[_$_22b8[30]][_$_22b8[42]]= cb_style_bold[_$_22b8[37]]?_$_22b8[43]:_$_22b8[4];element[_$_22b8[30]][_$_22b8[44]]= cb_style_italic[_$_22b8[37]]?_$_22b8[45]:_$_22b8[4];element[_$_22b8[30]][_$_22b8[48]]= sel_fontTransform[_$_22b8[31]]|| _$_22b8[4];if(sel_fontsize[_$_22b8[29]]> 0){element[_$_22b8[30]][_$_22b8[46]]= sel_fontsize[_$_22b8[31]]}else {if(ParseFloatToString(inp_fontsize[_$_22b8[31]])){element[_$_22b8[30]][_$_22b8[46]]= ParseFloatToString(inp_fontsize[_$_22b8[31]])+ sel_fontsize_unit[_$_22b8[31]]}else {element[_$_22b8[30]][_$_22b8[46]]= _$_22b8[4]}}};inp_color[_$_22b8[54]]= inp_color_Preview[_$_22b8[54]]= function inp_color_onclick(){SelectColor(inp_color,inp_color_Preview)}