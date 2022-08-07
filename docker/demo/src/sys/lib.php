<?php



function isNotXss($str){
	//把预定义的字符 "<" （小于）和 ">" （大于）转换为 HTML 实体
    $restr = preg_replace( '/<(.*)s(.*)c(.*)r(.*)i(.*)p(.*)t/i', '', $str);
    $restr = htmlspecialchars($restr);
	return $restr;
}

function is_pic($file_name) 
{ 
	$extend =explode("." , $file_name); 
	$va=count($extend)-1; 
	echo $extend[$va];
	if ($extend[$va]=='jpg' || $extend[$va]=='jpeg' || $extend[$va]=='png') {
		return 1;
	}
	else 
		return 0;	
}

function not_find($page)
{
	echo "<!DOCTYPE HTML PUBLIC \"-//IETF//DTD HTML 2.0//EN\"><html><head><title>404 Not Found</title></head><body><h1>Not Found</h1>
		<p>The requested URL ".$page." was not found on this server.</p></body></html>";
}
function getToken($len = 32, $md5 = true)
{
    mt_srand((double)microtime() * 1000000);

    # Array of characters, adjust as desired

    $chars = array(

        'Q',

        '@',

        '8',

        'y',

        '%',

        '^',

        '5',

        'Z',

        '(',

        'G',

        '_',

        'O',

        '`',

        'S',

        '-',

        'N',

        '<',

        'D',

        '{',

        '}',

        '[',

        ']',

        'h',

        ';',

        'W',

        '.',

        '/',

        '|',

        ':',

        '1',

        'E',

        'L',

        '4',

        '&',

        '6',

        '7',

        '#',

        '9',

        'a',

        'A',

        'b',

        'B',

        '~',

        'C',

        'd',

        '>',

        'e',

        '2',

        'f',

        'P',

        'g',

        ')',

        '?',

        'H',

        'i',

        'X',

        'U',

        'J',

        'k',

        'r',

        'l',

        '3',

        't',

        'M',

        'n',

        '=',

        'o',

        '+',

        'p',

        'F',

        'q',

        '!',

        'K',

        'R',

        's',

        'c',

        'm',

        'T',

        'v',

        'j',

        'u',

        'V',

        'w',

        ',',

        'x',

        'I',

        '$',

        'Y',

        'z',

        '*'

    );

    # Array indice friendly number of chars;

    $numChars = count($chars) - 1;

    $token = '';

    # Create random token at the specified length

    for ($i = 0; $i < $len; $i++)

        $token .= $chars[mt_rand(0, $numChars)];

    # Should token be run through md5?

    if ($md5) {

        # Number of 32 char chunks

        $chunks = ceil(strlen($token) / 32);

        $md5token = '';

        # Run each chunk through md5

        for ($i = 1; $i <= $chunks; $i++)

            $md5token .= md5(substr($token, $i * 32 - 32, 32));

        # Trim the token

        $token = substr($md5token, 0, $len);

    }

    return $token;

}
?>