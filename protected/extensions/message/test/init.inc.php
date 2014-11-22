<?
require_once("phpagi-asmanager.php");
require_once("config.inc.php");

/* set global debug flag */
$debug = 0;

/**
 * Init Asterisk Manager connection
 *
 */
function initASM()
{
        $ami = new AGI_AsteriskManager();
        $result = $ami->connect(CFG_AGI_HOST_PBX, CFG_AGI_USER_PBX, CFG_AGI_PWD_PBX);

        return $ami;
}
//�������ݿ������
function dbConnect($debug = false)
{
    global $db;
    if (!isset($db)) {
        require_once("lib/adodb/adodb.inc.php");
        $db = NewADOConnection("mysql");
        $db->debug = $debug;
        $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
        if (!$db->Connect("db-server", "justcall_luojie", "foobar2008", CFG_DB_NAME)) {
			return "the CTI server is busy.";
        }
    }
    return $db;
}
//PBX���ݿ������
function dbPbxConnect($debug = false)
{
    global $dbPbx;
    if (!isset($dbPbx)) {
        require_once("lib/adodb/adodb.inc.php");
        $dbPbx = NewADOConnection("mysql");
        $dbPbx->debug = $debug;
        $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
        if (!$dbPbx->Connect("db-server", "justcall_luojie","foobar2008", CFG_DB_NAME_PBX)) {
            //exit('<a href="/" target="_top">PBX������æ,���Ժ��ٷ���</a>');
			return "the PBX server is busy.";
        }
    }
    return $dbPbx;
}
?>
