<?php
function di( $value ) {
	global $sy;
	$sy['debug']->log('Debugging - '.json_encode($value));
	echo "<pre>";
	print_r ( $value );
	echo "</pre>";
	
}

function first_page() {
	global $in;

	$return = 1;
	
	foreach ( $in as $key => $value ) {
		if ( $in['post_id'] && empty($in['module']) && empty($in['action']) && empty($in['dir']) && empty($in['file']) && empty($in['skin']) ) $return = 0;
	}
	
	if ( isset($in['module']) ) $return = 0;
	else if ( isset($in['skin']) ) $return = 0;
	else if ( isset($in['page'] ) ) $return = 0;

	return $return;
}

function domain($url = null){

if ( empty($url) ) $url = "http://".$_SERVER['HTTP_HOST'];
$purl  = parse_url($url);
$host  = strtolower($purl['host']);

$valid_tlds = ".ab.ca .bc.ca .mb.ca .nb.ca .nf.ca .nl.ca .ns.ca .nt.ca .nu.ca .on.ca .pe.ca .qc.ca .sk.ca .yk.ca .com.cd .net.cd .org.cd .com.ch .net.ch .org.ch .gov.ch .co.ck .ac.cn .com.cn .edu.cn .gov.cn .net.cn .org.cn .ah.cn .bj.cn .cq.cn .fj.cn .gd.cn .gs.cn .gz.cn .gx.cn .ha.cn .hb.cn .he.cn .hi.cn .hl.cn .hn.cn .jl.cn .js.cn .jx.cn .ln.cn .nm.cn .nx.cn .qh.cn .sc.cn .sd.cn .sh.cn .sn.cn .sx.cn .tj.cn .xj.cn .xz.cn .yn.cn .zj.cn .com.co .edu.co .org.co .gov.co .mil.co .net.co .nom.co .com.cu .edu.cu .org.cu .net.cu .gov.cu .inf.cu .gov.cx .edu.do .gov.do .gob.do .com.do .org.do .sld.do .web.do .net.do .mil.do .art.do .com.dz .org.dz .net.dz .gov.dz .edu.dz .asso.dz .pol.dz .art.dz .com.ec .info.ec .net.ec .fin.ec .med.ec .pro.ec .org.ec .edu.ec .gov.ec .mil.ec .com.ee .org.ee .fie.ee .pri.ee .eun.eg .edu.eg .sci.eg .gov.eg .com.eg .org.eg .net.eg .mil.eg .com.es .nom.es .org.es .gob.es .edu.es .com.et .gov.et .org.et .edu.et .net.et .biz.et .name.et .info.et .co.fk .org.fk .gov.fk .ac.fk .nom.fk .net.fk .tm.fr .asso.fr .nom.fr .prd.fr .presse.fr .com.fr .gouv.fr .com.ge .edu.ge .gov.ge .org.ge .mil.ge .net.ge .pvt.ge .co.gg .net.gg .org.gg .com.gi .ltd.gi .gov.gi .mod.gi .edu.gi .org.gi .com.gn .ac.gn .gov.gn .org.gn .net.gn .com.gr .edu.gr .net.gr .org.gr .gov.gr .com.hk .edu.hk .gov.hk .idv.hk .net.hk .org.hk .com.hn .edu.hn .org.hn .net.hn .mil.hn .gob.hn .iz.hr .from.hr .name.hr .com.hr .com.ht .net.ht .firm.ht .shop.ht .info.ht .pro.ht .adult.ht .org.ht .art.ht .pol.ht .rel.ht .asso.ht .perso.ht .coop.ht .med.ht .edu.ht .gouv.ht .gov.ie .co.in .firm.in .net.in .org.in .gen.in .ind.in .nic.in .ac.in .edu.in .res.in .gov.in .mil.in .ac.ir .co.ir .gov.ir .net.ir .org.ir .sch.ir .gov.it .co.je .net.je .org.je .edu.jm .gov.jm .com.jm .net.jm .com.jo .org.jo .net.jo .edu.jo .gov.jo .mil.jo .co.kr .or.kr .com.kw .edu.kw .gov.kw .net.kw .org.kw .mil.kw .edu.ky .gov.ky .com.ky .org.ky .net.ky .org.kz .edu.kz .net.kz .gov.kz .mil.kz .com.kz .com.li .net.li .org.li .gov.li .gov.lk .sch.lk .net.lk .int.lk .com.lk .org.lk .edu.lk .ngo.lk .soc.lk .web.lk .ltd.lk .assn.lk .grp.lk .hotel.lk .com.lr .edu.lr .gov.lr .org.lr .net.lr .org.ls .co.ls .gov.lt .mil.lt .gov.lu .mil.lu .org.lu .net.lu .com.lv .edu.lv .gov.lv .org.lv .mil.lv .id.lv .net.lv .asn.lv .conf.lv .com.ly .net.ly .gov.ly .plc.ly .edu.ly .sch.ly .med.ly .org.ly .id.ly .co.ma .net.ma .gov.ma .org.ma .tm.mc .asso.mc .org.mg .nom.mg .gov.mg .prd.mg .tm.mg .com.mg .edu.mg .mil.mg .com.mk .org.mk .com.mo .net.mo .org.mo .edu.mo .gov.mo .org.mt .com.mt .gov.mt .edu.mt .net.mt .com.mu .co.mu .aero.mv .biz.mv .com.mv .coop.mv .edu.mv .gov.mv .info.mv .int.mv .mil.mv .museum.mv .name.mv .net.mv .org.mv .pro.mv .com.mx .net.mx .org.mx .edu.mx .gob.mx .com.my .net.my .org.my .gov.my .edu.my .mil.my .name.my .edu.ng .com.ng .gov.ng .org.ng .net.ng .gob.ni .com.ni .edu.ni .org.ni .nom.ni .net.ni .gov.nr .edu.nr .biz.nr .info.nr .com.nr .net.nr .ac.nz .co.nz .cri.nz .gen.nz .geek.nz .govt.nz .iwi.nz .maori.nz .mil.nz .net.nz .org.nz .school.nz .com.pf .org.pf .edu.pf .com.pg .net.pg .com.ph .gov.ph .com.pk .net.pk .edu.pk .org.pk .fam.pk .biz.pk .web.pk .gov.pk .gob.pk .gok.pk .gon.pk .gop.pk .gos.pk .com.pl .biz.pl .net.pl .art.pl .edu.pl .org.pl .ngo.pl .gov.pl .info.pl .mil.pl .waw.pl .warszawa.pl .wroc.pl .wroclaw.pl .krakow.pl .poznan.pl .lodz.pl .gda.pl .gdansk.pl .slupsk.pl .szczecin.pl .lublin.pl .bialystok.pl .olsztyn.pl .torun.pl .biz.pr .com.pr .edu.pr .gov.pr .info.pr .isla.pr .name.pr .net.pr .org.pr .pro.pr .edu.ps .gov.ps .sec.ps .plo.ps .com.ps .org.ps .net.ps .com.pt .edu.pt .gov.pt .int.pt .net.pt .nome.pt .org.pt .publ.pt .net.py .org.py .gov.py .edu.py .com.py .com.ru .net.ru .org.ru .pp.ru .msk.ru .int.ru .ac.ru .gov.rw .net.rw .edu.rw .ac.rw .com.rw .co.rw .int.rw .mil.rw .gouv.rw .com.sa .edu.sa .sch.sa .med.sa .gov.sa .net.sa .org.sa .pub.sa .com.sb .gov.sb .net.sb .edu.sb .com.sc .gov.sc .net.sc .org.sc .edu.sc .com.sd .net.sd .org.sd .edu.sd .med.sd .tv.sd .gov.sd .info.sd .org.se .pp.se .tm.se .parti.se .press.se .ab.se .c.se .d.se .e.se .f.se .g.se .h.se .i.se .k.se .m.se .n.se .o.se .s.se .t.se .u.se .w.se .x.se .y.se .z.se .ac.se .bd.se .com.sg .net.sg .org.sg .gov.sg .edu.sg .per.sg .idn.sg .edu.sv .com.sv .gob.sv .org.sv .red.sv .gov.sy .com.sy .net.sy .ac.th .co.th .in.th .go.th .mi.th .or.th .net.th .ac.tj .biz.tj .com.tj .co.tj .edu.tj .int.tj .name.tj .net.tj .org.tj .web.tj .gov.tj .go.tj .mil.tj .com.tn .intl.tn .gov.tn .org.tn .ind.tn .nat.tn .tourism.tn .info.tn .ens.tn .fin.tn .net.tn .gov.to .gov.tp .com.tr .info.tr .biz.tr .net.tr .org.tr .web.tr .gen.tr .av.tr .dr.tr .bbs.tr .name.tr .tel.tr .gov.tr .bel.tr .pol.tr .mil.tr .k12.tr .edu.tr .co.tt .com.tt .org.tt .net.tt .biz.tt .info.tt .pro.tt .name.tt .edu.tt .gov.tt .gov.tv .edu.tw .gov.tw .mil.tw .com.tw .net.tw .org.tw .idv.tw .game.tw .ebiz.tw .club.tw .co.tz .ac.tz .go.tz .or.tz .ne.tz .com.ua .gov.ua .net.ua .edu.ua .org.ua .cherkassy.ua .ck.ua .chernigov.ua .cn.ua .chernovtsy.ua .cv.ua .crimea.ua .dnepropetrovsk.ua .dp.ua .donetsk.ua .dn.ua .if.ua .kharkov.ua .kh.ua .kherson.ua .ks.ua .khmelnitskiy.ua .km.ua .kiev.ua .kv.ua .kirovograd.ua .kr.ua .lugansk.ua .lg.ua .lutsk.ua .lviv.ua .nikolaev.ua .mk.ua .odessa.ua .od.ua .poltava.ua .pl.ua .rovno.ua .rv.ua .sebastopol.ua .sumy.ua .ternopil.ua .te.ua .uzhgorod.ua .vinnica.ua .vn.ua .zaporizhzhe.ua .zp.ua .zhitomir.ua .zt.ua .co.ug .ac.ug .sc.ug .go.ug .ne.ug .or.ug .ac.uk .co.uk .gov.uk .ltd.uk .me.uk .mil.uk .mod.uk .net.uk .nic.uk .nhs.uk .org.uk .plc.uk .police.uk .bl.uk .icnet.uk .jet.uk .nel.uk .nls.uk .parliament.uk .sch.uk .ak.us .al.us .ar.us .az.us .ca.us .co.us .ct.us .dc.us .de.us .dni.us .fed.us .fl.us .ga.us .hi.us .ia.us .id.us .il.us .in.us .isa.us .kids.us .ks.us .ky.us .la.us .ma.us .md.us .me.us .mi.us .mn.us .mo.us .ms.us .mt.us .nc.us .nd.us .ne.us .nh.us .nj.us .nm.us .nsn.us .nv.us .ny.us .oh.us .ok.us .or.us .pa.us .ri.us .sc.us .sd.us .tn.us .tx.us .ut.us .vt.us .va.us .wa.us .wi.us .wv.us .wy.us .edu.uy .gub.uy .org.uy .com.uy .net.uy .mil.uy .com.ve .net.ve .org.ve .info.ve .co.ve .web.ve .com.vi .org.vi .edu.vi .gov.vi .com.vn .net.vn .org.vn .edu.vn .gov.vn .int.vn .ac.vn .biz.vn .info.vn .name.vn .pro.vn .health.vn .com.ye .net.ye .ac.yu .co.yu .org.yu .edu.yu .ac.za .city.za .co.za .edu.za .gov.za .law.za .mil.za .nom.za .org.za .school.za .alt.za .net.za .ngo.za .tm.za .web.za .co.zm .org.zm .gov.zm .sch.zm .ac.zm .co.zw .org.zw .gov.zw .ac.zw .com.ac .edu.ac .gov.ac .net.ac .mil.ac .org.ac .nom.ad .net.ae .co.ae .gov.ae .ac.ae .sch.ae .org.ae .mil.ae .pro.ae .name.ae .com.ag .org.ag .net.ag .co.ag .nom.ag .off.ai .com.ai .net.ai .org.ai .gov.al .edu.al .org.al .com.al .net.al .com.am .net.am .org.am .com.ar .net.ar .org.ar .e164.arpa .ip6.arpa .uri.arpa .urn.arpa .gv.at .ac.at .co.at .or.at .com.au .net.au .asn.au .org.au .id.au .csiro.au .gov.au .edu.au .com.aw .com.az .net.az .org.az .com.bb .edu.bb .gov.bb .net.bb .org.bb .com.bd .edu.bd .net.bd .gov.bd .org.bd .mil.be .ac.be .gov.bf .com.bm .edu.bm .org.bm .gov.bm .net.bm .com.bn .edu.bn .org.bn .net.bn .com.bo .org.bo .net.bo .gov.bo .gob.bo .edu.bo .tv.bo .mil.bo .int.bo .agr.br .am.br .art.br .edu.br .com.br .coop.br .esp.br .far.br .fm.br .g12.br .gov.br .imb.br .ind.br .inf.br .mil.br .net.br .org.br .psi.br .rec.br .srv.br .tmp.br .tur.br .tv.br .etc.br .adm.br .adv.br .arq.br .ato.br .bio.br .bmd.br .cim.br .cng.br .cnt.br .ecn.br .eng.br .eti.br .fnd.br .fot.br .fst.br .ggf.br .jor.br .lel.br .mat.br .med.br .mus.br .not.br .ntr.br .odo.br .ppg.br .pro.br .psc.br .qsl.br .slg.br .trd.br .vet.br .zlg.br .dpn.br .nom.br .com.bs .net.bs .org.bs .com.bt .edu.bt .gov.bt .net.bt .org.bt .co.bw .org.bw .gov.by .mil.by .ac.cr .co.cr .ed.cr .fi.cr .go.cr .or.cr .sa.cr .com.cy .biz.cy .info.cy .ltd.cy .pro.cy .net.cy .org.cy .name.cy .tm.cy .ac.cy .ekloges.cy .press.cy .parliament.cy .com.dm .net.dm .org.dm .edu.dm .gov.dm .biz.fj .com.fj .info.fj .name.fj .net.fj .org.fj .pro.fj .ac.fj .gov.fj .mil.fj .school.fj .com.gh .edu.gh .gov.gh .org.gh .mil.gh .co.hu .info.hu .org.hu .priv.hu .sport.hu .tm.hu .2000.hu .agrar.hu .bolt.hu .casino.hu .city.hu .erotica.hu .erotika.hu .film.hu .forum.hu .games.hu .hotel.hu .ingatlan.hu .jogasz.hu .konyvelo.hu .lakas.hu .media.hu .news.hu .reklam.hu .sex.hu .shop.hu .suli.hu .szex.hu .tozsde.hu .utazas.hu .video.hu .ac.id .co.id .or.id .go.id .ac.il .co.il .org.il .net.il .k12.il .gov.il .muni.il .idf.il .co.im .net.im .gov.im .org.im .nic.im .ac.im .org.jm .ac.jp .ad.jp .co.jp .ed.jp .go.jp .gr.jp .lg.jp .ne.jp .or.jp .hokkaido.jp .aomori.jp .iwate.jp .miyagi.jp .akita.jp .yamagata.jp .fukushima.jp .ibaraki.jp .tochigi.jp .gunma.jp .saitama.jp .chiba.jp .tokyo.jp .kanagawa.jp .niigata.jp .toyama.jp .ishikawa.jp .fukui.jp .yamanashi.jp .nagano.jp .gifu.jp .shizuoka.jp .aichi.jp .mie.jp .shiga.jp .kyoto.jp .osaka.jp .hyogo.jp .nara.jp .wakayama.jp .tottori.jp .shimane.jp .okayama.jp .hiroshima.jp .yamaguchi.jp .tokushima.jp .kagawa.jp .ehime.jp .kochi.jp .fukuoka.jp .saga.jp .nagasaki.jp .kumamoto.jp .oita.jp .miyazaki.jp .kagoshima.jp .okinawa.jp .sapporo.jp .sendai.jp .yokohama.jp .kawasaki.jp .nagoya.jp .kobe.jp .kitakyushu.jp .per.kh .com.kh .edu.kh .gov.kh .mil.kh .net.kh .org.kh .net.lb .org.lb .gov.lb .edu.lb .com.lb .com.lc .org.lc .edu.lc .gov.lc .army.mil .navy.mil .weather.mobi .music.mobi .ac.mw .co.mw .com.mw .coop.mw .edu.mw .gov.mw .int.mw .museum.mw .net.mw .org.mw .mil.no .stat.no .kommune.no .herad.no .priv.no .vgs.no .fhs.no .museum.no .fylkesbibl.no .folkebibl.no .idrett.no .com.np .org.np .edu.np .net.np .gov.np .mil.np .org.nr .com.om .co.om .edu.om .ac.com .sch.om .gov.om .net.om .org.om .mil.om .museum.om .biz.om .pro.om .med.om .com.pa .ac.pa .sld.pa .gob.pa .edu.pa .org.pa .net.pa .abo.pa .ing.pa .med.pa .nom.pa .com.pe .org.pe .net.pe .edu.pe .mil.pe .gob.pe .nom.pe .law.pro .med.pro .cpa.pro .vatican.va .ac .ad .ae .aero .af .ag .ai .al .am .an .ao .aq .ar .arpa .as .at .au .aw .az .ba .bb .bd .be .bf .bg .bh .bi .biz .bj .bm .bn .bo .br .bs .bt .bv .bw .by .bz .ca .cat .cc .cd .cf .cg .ch .ci .ck .cl .cm .cn .co .com .coop .cr .cu .cv .cx .cy .cz .de .dj .dk .dm .do .dz .ec .edu .ee .eg .er .es .et .eu .fi .fj .fk .fm .fo .fr .ga .gb .gd .ge .gf .gg .gh .gi .gl .gm .gov .gp .gq .gr .gs .gt .gu .gw .gy .hk .hm .hn .hr .ht .hu .id .ie .il .im .in .info .int .io .iq .ir .is .it .je .jm .jo .jobs .jp .ke .kg .kh .ki .km .kn .kr .kw .ky .kz .la .lb .lc .li .lk .lr .ls .lt .lu .lv .ly .ma .mc .md .mg .mh .mil .mk .ml .mm .mn .mo .mobi .mp .mq .mr .ms .mt .mu .museum .mv .mw .na .name .nc .ne .net .nf .ng .ni .nl .no .np .nr .nu .nz .om .org .pa .pe .pf .pg .ph .pk .pl .pm .pn .post .pr .pro .ps .pt .pw .py .qa .re .ro .ru .rw .sa .sb .sc .sd .se .sg .sh .si .sj .sk .sl .sm .sn .so .sr .st .su .sv .sy .sz .tc .td .tf .tg .th .tj .tk .tl .tm .tn .to .tp .tr .travel .tt .tv .tw .tz .ua .ug .uk .um .us .uy .uz .va .vc .ve .vg .vi .vn .vuwf .ye .yt .yu .za .zm .zw .ca .cd .ch .cn .cu .cx .dm .dz .ec .ee .es .fr .ge .gg .gi .gr .hk .hn .hr .ht .hu .ie .in .ir .it .je .jo .jp .kr .ky .li .lk .lt .lu .lv .ly .ma .mc .mg .mk .mo .mt .mu .nl .no .nr .nr .pf .ph .pk .pl .pr .ps .pt .ro .ru .rw .sc .sd .se .sg .tj .to .to .tt .tv .tw .tw .tw .tw .ua .ug .us .vi .vn";



    $tld_regex = '#(.*?)([^.]+)('.str_replace(array('.',' '),array('\\.','|'),$valid_tlds).')$#';

    //remove the extension
    preg_match($tld_regex,$host,$matches);

    if(!empty($matches) && sizeof($matches) > 2){
		$matches[1] = str_replace('.','', $matches[1]);
		return $matches;
        //$extension = array_pop($matches);
        //$tld = array_pop($matches);
       //return $tld.$extension;
		//return $extension;

    }else{ //change to "false" if you prefer
        return $host;
    }

}

function root_domain($url = null ) {
	$domain = domain($url);
	
	return $domain[2];
}

function sub_domain($url = null ) {
	$domain = domain($url);
	if ( $domain[1] != 'www' ) return $domain[1];
}

function site_path() {
	global $site_config;
	if ( !$layout = $site_config['layout'] ) $layout = 'default';
	
	return INDEX_PATH . "/" . $layout;
}

function site_url() {
	$host = "//".$_SERVER['HTTP_HOST'];
	
	$pathinfo = pathinfo($_SERVER['PHP_SELF']);
	if ( $pathinfo['dirname'] ) $host .= $pathinfo['dirname'];
	
	return $host;
}

function css_header_path() {
	return site_path() . "/css/css.header.php";
}

function js_header_path() {
	return site_path() . "/js/js.header.php";
}

// css를 인클루드 하는 함수

function css( $pathname, $filename ) {
	global $site_config, $sy;
	
	
	if ( empty($site_config['version']) ) $site_config['version'] = 1;
	
	$css_url = "<link rel='stylesheet' type='text/css' href='". INDEX_PATH . "/" . $site_config['layout'] . "/" . $pathname . "/" . $filename . ".css?v=".$site_config['version']."' />";
	if ( $site_config['use_css_in_header'] ) {  
		$data = '$css_header["'.$pathname.".".$filename.'"]="'.$css_url.'";';
		
		// 동일한 CSS 파일이 포함된 경우는 파일을 쓰지 않는다.
		$css_header_data =  $sy['file']->read_file ( css_header_path() );
		if ( !preg_match("/".$pathname.".".$filename."/", $css_header_data ) ) {
			$sy['file']->write_file( css_header_path(), $data, 'a+');
		}
	}
	else return $css_url;
}

// module css를 인클루드 하는 함수
function module_css ( $filename  ) {
	global $site_config, $in, $sy;
	
	$pathinfo = pathinfo( $filename );
	
	if ( empty($in['module']) ) {
		$dirs = explode(DIRECTORY_SEPARATOR, $pathinfo['dirname']);
		$dir_index =  count($dirs) - 1;
		$module = $dirs[$dir_index];
	} else $module = $in['module'];
	
	if ( empty($site_config['version']) ) $site_config['version'] = 1;
	
	$css_url = "<link rel='stylesheet' type='text/css' href='". MODULE_PATH . "/" . $module . '/css' . "/" . $pathinfo['filename'] . ".css?v=".$site_config['version']."' />";
	
	if ( $site_config['use_css_in_header'] ) {  
		$data = '$css_header["'.$module.".".$pathinfo['filename'].'"]="'.$css_url.'";';
		
		// 동일한 CSS 파일이 포함된 경우는 파일을 쓰지 않는다.
		$css_header_data =  $sy['file']->read_file ( css_header_path() );
		if ( !preg_match("/".$in['module'].".".$pathinfo['filename']."/", $css_header_data ) ) {
			$sy['file']->write_file( css_header_path(), $data, 'a+');
		}
	}
	else return $css_url;
}

// javascript를 인클루드 하는 함수

function javascript( $pathname, $filename ) {
	global $site_config, $sy;
	
	if ( empty($site_config['version']) ) $site_config['version'] = 1;
	
	
	$js_url = "<script src='". INDEX_PATH . "/" . $site_config['layout'] . "/" . $pathname . "/" . $filename . ".js?v=".$site_config['version']."'></script>";
	
	if ( $site_config['use_js_in_header'] ) {  
		$data = '$js_header["'.$pathname.".".$filename.'"]="'.$js_url.'";';
		// 동일한 js 파일이 포함된 경우는 파일을 쓰지 않는다.
		$js_header_data =  $sy['file']->read_file ( js_header_path() );
		if ( !preg_match("/".$pathname.".".$filename."/", $js_header_data ) ) {
			$sy['file']->write_file( js_header_path(), $data, 'a+');
		}
	} else return $js_url;
}



// module javascript를 인클루드 하는 함수
function module_javascript ( $filename  ) {
	global $site_config, $in, $sy;
	
	$pathinfo = pathinfo( $filename );
	if ( empty($in['module']) ) {
		$dirs = explode(DIRECTORY_SEPARATOR, $pathinfo['dirname']);
		$dir_index =  count($dirs) - 1;
		$module = $dirs[$dir_index];
	} else $module = $in['module'];
		
	
	if ( empty($site_config['version']) ) $site_config['version'] = 1;
	
	$js_url = "<script src='". MODULE_PATH . "/" . $module . "/js/" . $pathinfo['filename'] . ".js?v=".$site_config['version']."'></script>";
	
	if ( $site_config['use_js_in_header'] ) {  
		$data = '$js_header["'.$module.".".$pathinfo['filename'].'"]="'.$js_url.'";';
		// 동일한 js 파일이 포함된 경우는 파일을 쓰지 않는다.
		$js_header_data =  $sy['file']->read_file ( js_header_path() );
		if ( !preg_match("/".$in['module'].".".$pathinfo['filename']."/", $js_header_data ) ) {
			$sy['file']->write_file( js_header_path(), $data, 'a+');
		}
	} else return $js_url;	
}


// skin을 인클루드 하는 함수
function load_skin( $skinname, $skin, $option = array() ) {
	global $sy, $in, $site_config, $_member, $p, $post_cfg, $_comments, $comment, $_category, $posts, $_lang;
	
	$skin_path = SKIN_PATH . "/".$skinname . "/".$skin;
	
	// 사용자가 추가한 스킨 옵션이 있다면 $skin_option, $so에 해당 배열을 저장한다.
	$skin_option = $so = array();
	if ( $option ) $skin_option = $so = $option;
	
	// 기본 스킨 옵션 처리
	$skin_option['path'] = $so['path'] = $skin_path;
	$skin_option['kind'] = $so['kind'] = $skinname;
	$skin_option['skin'] = $so['skin'] = $skin;
	
	include $skin_path .'/main.php';
}


// skin css를 인클루드 하는 함수
function skin_css( $so, $filename ) {
	global $site_config, $sy;
	
	$pathinfo = pathinfo($filename);
	
	$path = $so['path'];
	
	if ( empty($site_config['version']) ) $site_config['version'] = 1;
	
	$css_url = "<link rel='stylesheet' type='text/css' href='{$path}/css/" . $pathinfo['filename'] . ".css?v=".$site_config['version']."' />";
	
	if ( $site_config['use_css_in_header'] ) {  
		$data = '$css_header["'.$so['kind'].".".$so['skin'].$pathinfo['filename'].'"]="'.$css_url.'";';
		
		// 동일한 CSS 파일이 포함된 경우는 파일을 쓰지 않는다.
		$css_header_data =  $sy['file']->read_file ( css_header_path() );
		if ( !preg_match("/".$so['kind'].".".$so['skin'].$pathinfo['filename']."/", $css_header_data ) ) {
			$sy['file']->write_file( css_header_path(), $data, 'a+');
		}
	}
	else return $css_url;
}

// skin javascript를 인클루드 하는 함수
function skin_javascript( $so, $filename ) {
	global $site_config, $sy;
	
	$pathinfo = pathinfo($filename);
	
	$path = $so['path'];
	
	if ( empty($site_config['version']) ) $site_config['version'] = 1;
	
	$js_url = "<script src='{$path}/js/" . $pathinfo['filename'] . ".js?v=".$site_config['version']."'></script>";
	
	if ( $site_config['use_js_in_header'] ) {  
		$data = '$js_header["'.$so['kind'].".".$so['skin'].$pathinfo['filename'].'"]="'.$js_url.'";';
		
		// 동일한 CSS 파일이 포함된 경우는 파일을 쓰지 않는다.
		$js_header_data =  $sy['file']->read_file ( js_header_path() );
		if ( !preg_match("/".$so['kind'].".".$so['skin'].$pathinfo['filename']."/", $js_header_data ) ) {
			$sy['file']->write_file( js_header_path(), $data, 'a+');
		}
	}
	else return $js_url;
}

/*
* 32비트 환경에서는 음수로 나와 데이터베이스 저장 시 에러가 발생한다. 이를 방지하기 위해 
* 다음과 같은 함수를 사용한다.
*/
	
function ip_2_long($ip)
{
	$ip = trim($ip);
	if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) return 0;
	return sprintf("%u", ip2long($ip));  
}

// Number to IP Address
function long_2_ip($num)
{
	$num = trim($num);
	if ($num == "0") return "0.0.0.0";
	return long2ip(-(4294967295 - ($num - 1))); 
}

function set_browser_id() {
	if ( isset($_COOKIE[md5('browser_id')])) {}
	else {
		$browser_id = $_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR'].$_['HTTP_ACCEPT_LANGUAGE'];
		setcookie(md5('browser_id'), md5($browser_id), time() + (60 * 60 * 24 *120) , "/", COOKIE_DOMAIN);
	}
}

function get_browser_id() {
	
	if ( $_COOKIE[md5('browser_id')] ) {
		return $_COOKIE[md5('browser_id')];
	}
}

function admin() {
	global $_member;

	if ( $_member['is_admin'] == 'Y' ) return 1;
}

// 모바일 브라우저 체크 
function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

// gid
function gid() {
	return md5(uniqid("gid", true));
}

function ago($time)
{
   $periods = array("초", "분", "시간", "일", "주", "달", "년", "오래");
   $lengths = array("60","60","24","7","4.35","12","10");

   $now = time();

       $difference     = $now - $time;
       $tense         = "ago";

   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
       $difference /= $lengths[$j];
   }

   $difference = round($difference);
/*
   if($difference != 1) {
       $periods[$j].= "s";
   }
*/
   return "$difference $periods[$j]전 ";
}


function stamp_today() {
	$date = explode('-', date('y-m-d') );
	
	
	return mktime( 0, 0, 0, $date[1], $date[2], $date[0] );
}

function stamp_this_month() {
	$date = explode('-', date('y-m-d') );
	
	
	return mktime( 0, 0, 0, $date[1], 1, $date[0] );
}

function stamp_next_month() {
	$date = explode('-', date('y-m-d') );
	
	
	return mktime( 0, 0, 0, $date[1] + 1, 1, $date[0] );
}

function stamp_this_year() {
	$date = explode('-', date('y-m-d') );
	
	
	return mktime( 0, 0, 0, 1, 1, $date[0] );
}

function stamp_next_year() {
	$date = explode('-', date('y-m-d') );
	
	
	return mktime( 0, 0, 0, 1, 1, $date[0] + 1 );
}

function left_seconds_of_day() {
	return stamp_today() + ( 60 * 60 * 24 ) - time();
}

function date2stamp ( $date = null ) {
	if ( empty ( $date ) ) $date = date('Y-m-d');
	
	$date_split = explode( '-', $date );

	return $stamp = mktime ( 0, 0, 0, $date_split[1], $date_split[2], $date_split[0] );
}

function stringcut( $word, $length = 60 ) {
	$s = mb_strcut( $word, 0, $length, 'UTF-8' );
	if ( strlen($word) > $length ) $s .="...";
	return stripslashes($s);
}

function user_agent($user_agent = null) {
	
	if (empty($user_agent)) $user_agent =  $_SERVER['HTTP_USER_AGENT'];
	
	// check if IE 8 - 11+
    preg_match('/Trident\/(.*)/',$user_agent, $matches);
    if ($matches) {
        $version = intval($matches[1]) + 4;     // Trident 4 for IE8, 5 for IE9, etc
        return 'IE'.($version <= 11 ? $version : 'Edge');
    }

    // check if IE 6 - 7
    // you don't need this as of 2014, but who knows what's your project specifications.
    /*preg_match('/MSIE (.*)/', $_SERVER['HTTP_USER_AGENT'], $matches);
    if ($matches) {
        return 'Internet Explorer '.intval($matches[1]);
    }*/

    // check if Firefox, Opera, Chrome, Safari
    foreach (array('Firefox', 'OPR', 'Chrome', 'Safari', 'Android') as $browser) {
        preg_match('/'.$browser.'/',$user_agent, $matches);
        if ($matches) {
            return str_replace('OPR', 'Opera', $browser);   // we don't care about the version, because this is a modern browser that updates itself unlike IE
        }
    }
}

// 언어 
function user_language() {
	$user_language = explode (',' , $_SERVER['HTTP_ACCEPT_LANGUAGE'] );
	return $user_language[0];
	
}

// 방문자 통계 추가
function insert_visit_stat() {
	global $sy;
	
	// 24시간 이내에 방문을 했다면 테이블에 추가하지 않는다.
	if ( sub_domain() ) $domain = sub_domain().".".root_domain();
	else $domain = root_domain();
	$stamp_today = stamp_today();
	$stamp_next_day = stamp_today() + (60 * 60 * 24);
	$ip = ip_2_long($_SERVER['REMOTE_ADDR']);
	
	$count = $sy['db']->row("SELECT COUNT(*) as cnt FROM " . VISITOR_STAT_TABLE . " WHERE `domain`='$domain' AND `ip`='$ip' AND user_agent='".$_SERVER['HTTP_USER_AGENT']."' AND ( `stamp` >= '$stamp_today' AND `stamp` < '$stamp_next_day')");

	// 24시간 이내에 방문을 하지 않았다면 테이블에 추가 한다.
	if ( empty($count['cnt']) ) {
		$option = array(
						'domain'=>$domain,
						'stamp'=>time(),
						'ip'=>$ip,
						'user_agent'=>$_SERVER['HTTP_USER_AGENT'],
						'language'=>user_language(),
						'referer'=>$_SERVER['HTTP_REFERER']
						
		);
		$sy['db']->insert(VISITOR_STAT_TABLE, $option);
	}
	
}


// 이미지 리사이즈 함수
function imageresize ( $file_id, $width = 100, $height = 100, $quality = 80 ) {
	global $sy;
	if ( $file_id ) {
		$org = $sy['data']->upload_path ( $file_id );
		if ( file_exists ( $org ) ) {
			$image_info = getimagesize( $org );
			
			$dest = RESIZED_IMAGE_PATH . "/". $file_id."_".$width."_".$height;
			if ( !file_exists( $dest ) ) new imageresizer ( $org, $width, $height, $image_info['mime'], $quality, $dest );
			
			return $dest;
		}
	}
}

// 블로그 API 
function BlogPost($title, $description, $category = null, $tags = null, $no = 1 ) 
{ 
		global $blog_url, $user_id, $blog_id, $password, $publish, $blog_no;
		
		echo $blog_no;
		
		$client = 'client'.$no;
		$$client = new xmlrpc_client($blog_url);


		$$client->setSSLVerifyPeer(false); 
		$GLOBALS['xmlrpc_internalencoding']='UTF-8';

		$struct = array(
		'title' => new xmlrpcval($title, "string"), 
		'description' => new xmlrpcval(stripslashes($description), "string") 
		);
		if ( $category ) {
			$struct['categories'] = new xmlrpcval($category, "string");
		}
		
		if ( $tags ) {
			$struct['tags'] = new xmlrpcval($tags, "string");
		}
		if ( $blog_no ) {
			$f = 'f'.$no;
			$$f = new xmlrpcmsg("metaWeblog.editPost",
							array(
									new xmlrpcval($blog_no, "string"),
									new xmlrpcval($user_id, "string"),
									new xmlrpcval($password, "string"),
									new xmlrpcval($struct, "struct"),
									new xmlrpcval($publish, "boolean")
							)
				);
		}
		else {
			$f = 'f'.$no;
			$$f = new xmlrpcmsg("metaWeblog.newPost", 
						array( 
								new xmlrpcval($blog_id, "string"),
								new xmlrpcval($user_id, "string"),
								new xmlrpcval($password, "string"),
								new xmlrpcval($struct , "struct"), 
								new xmlrpcval($publish, "boolean")
					 )
			);
	}
			 
	$$f->request_charset_encoding = 'UTF-8';
	return $response = $$client->send($$f);
}

// xss 공격 방지 함수 

function xss_clean($data)
{
// Fix &entity\n;
$data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
$data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
$data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
$data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

// Remove any attribute starting with "on" or xmlns
$data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

// Remove javascript: and vbscript: protocols
$data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

// Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

// Remove namespaced elements (we do not need them)
$data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

do
{
	// Remove really unwanted tags
	$old_data = $data;
	$data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
}
while ($old_data !== $data);

// we are done...
return $data;
}


function isValidEmail($email, $checkDNS = false)
 {

     $valid = (
             /* Preference for native version of function */
             function_exists('filter_var') and filter_var($email, FILTER_VALIDATE_EMAIL)
             ) || (
                 /* The maximum length of an e-mail address is 320 octets, per RFC 2821. */
                 strlen($email) <= 320 
                 /*
                  * The regex below is based on a regex by Michael Rushton.
                  * However, it is not identical. I changed it to only consider routeable
                  * addresses as valid. Michael's regex considers a@b a valid address
                  * which conflicts with section 2.3.5 of RFC 5321 which states that:
                  *
                  * Only resolvable, fully-qualified domain names (FQDNs) are permitted
                  * when domain names are used in SMTP. In other words, names that can
                  * be resolved to MX RRs or address (i.e., A or AAAA) RRs (as discussed
                  * in Section 5) are permitted, as are CNAME RRs whose targets can be
                  * resolved, in turn, to MX or address RRs. Local nicknames or
                  * unqualified names MUST NOT be used.
                  *
                  * This regex does not handle comments and folding whitespace. While
                  * this is technically valid in an email address, these parts aren't
                  * actually part of the address itself.
                  */
                 and preg_match_all(
                     '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?))'. 
                     '{255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?))'.
                     '{65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|'.
                     '(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))'.
                     '(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|'.
                     '(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|'.
                     '(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})'.
                     '(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126})'.'{1,}'.
                     '(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|'.
                     '(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|'.
                     '(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::'.
                     '(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|'.
                     '(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|'.
                     '(?:(?!(?:.*[a-f0-9]:){5,})'.'(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::'.
                     '(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|'.
                     '(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|'.
                     '(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD',
                     $email)
             );
     
     if( $valid )
     {
         if( $checkDNS && ($domain = end(explode('@',$email, 2))) )
         {
             /*
             Note:
             Adding the dot enforces the root.
             The dot is sometimes necessary if you are searching for a fully qualified domain
             which has the same name as a host on your local domain.
             Of course the dot does not alter results that were OK anyway.
             */
             return checkdnsrr($domain . '.', 'MX');
         }
         return true;
     }
     return false;
 }
 
 function mailer($option ) {
	
	if ( $option['to'] && $option['subject'] && $option['content'] ) {
		
		// 메일 수신자
		
		$to = implode(",", $option['to']);  // 다수 사용자의 경우는 ,로 구분 한다.
	
		// HTML 이메일을 보내기 위해서는 아래의 헤더 정보를 포함해야 한다.
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

		// 추가 설정
		if ( $option['from'] ) $headers .= 'From: '. $option['from'] . "\r\n";
		if ( $option['cc'] ) $headers .= 'Cc: ' . $option['cc'] . "\r\n";
		if ( $option['bcc'] ) $headers .= 'Bcc: ' . $option['bcc'] . "\r\n";

	// 메일 보내기
	return mail($to, $option['subject'], $option['content'], $headers);
	}
 }
 
 // 언어별 배열 리턴
 function load_lang($_lang) {
	
	if ( preg_match("/^en/", $_lang) ) include_once LANG_PATH . '/en.php';
	else if ( preg_match("/^ko/", $_lang) ) include_once LANG_PATH ."/ko.php";
	else if ( preg_match("/^zh/", $_lang) ) include_once LANG_PATH ."/en.php";
	else if ( preg_match("/^ja/", $_lang) ) include_once LANG_PATH ."/en.php";
	else if ( preg_match("/^tl/", $_lang) ) include_once LANG_PATH ."/en.php";
	else include_once LANG_PATH . '/en.php';
	
	return $_ln;
 }
 
// 언어 값 가져오기
function lang( $word ) {
	global $_ln;
	
	if ( $_ln[$word] ) return $_ln[$word];
	else return $word;
}


// 팝업 설정 가져오기
function popup_config($seq = null) {
	global $sy, $site_config;
			
	if ( empty($seq) ) $seq = $site_config['domain'];
		
	$conds = null;
		
	if ( is_numeric($seq) ) { // seq 인 경우
		$conds = "`seq`=$seq";
	}
	else { // 도메인인 경우
		$conds = "`domain`='$seq'";
	}
		
	if ( $conds ) {
		return $sy['db']->row("SELECT * FROM ". POPUP_CONFIG_TABLE . " WHERE $conds");
	}
}

// 사이트별 어드민
function site_admin() {
	global $site_config, $_member, $sy;
	
	if ( $site_config['admin'] && $sy['mb']->is_login() ) {
		$admins = explode(",", $site_config['admin']);
		if ( in_array($_member['username'], $admins) ) return 1;
	}
}

// 스킨 목록을 종류 별로 가져온다.
function skin_list( $skinname, $skin_value = null ) {
	global $sy;
		
	ob_start();
		
	$skin_dir = $sy['file']->readdir( SKIN_PATH . '/'.$skinname );
		
	$skin_desc = array();
	foreach ( $skin_dir as $dir ) {
		include SKIN_PATH .'/'.$skinname.'/'.$dir.'/desc.php';
		$skin_desc[$dir] = $desc['name'];
	}
	echo "<select name='{$skinname}_skin'>
			<option value=''>스킨선택</option>
			<option value=''></option>";
	foreach ( $skin_desc as $key => $value ) {
		if  ( $skin_value ) {
			if ( $skin_value == $key ) $selected = 'selected';
			else $selected = null;
		}
		echo "<option value='$key' $selected>$value</option>";
	}
	echo "</select>";
		
	$sel_skin_list = ob_get_clean();
	return $sel_skin_list;
}
?>