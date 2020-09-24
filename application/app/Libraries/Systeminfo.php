<?php

namespace App\Libraries;

class Systeminfo {

  public function getInfoFromUserAgent() {

    if ( isset( $_SERVER ) ) {
        $agent = $_SERVER['HTTP_USER_AGENT'];
    }
    else {
        global $HTTP_SERVER_VARS;
        if ( isset( $HTTP_SERVER_VARS ) ) {
            $agent = $HTTP_SERVER_VARS['HTTP_USER_AGENT'];
        }
        else {
            global $HTTP_USER_AGENT;
            $agent = $HTTP_USER_AGENT;
        }
    }
    $ros[] = array('Windows XP', 'Windows XP');
    $ros[] = array('Windows NT 5.1|Windows NT5.1)', 'Windows XP');
    $ros[] = array('Windows 2000', 'Windows 2000');
    $ros[] = array('Windows NT 5.0', 'Windows 2000');
    $ros[] = array('Windows NT 4.0|WinNT4.0', 'Windows NT');
    $ros[] = array('Windows NT 5.2', 'Windows Server 2003');
    $ros[] = array('Windows NT 6.0', 'Windows Vista');
    $ros[] = array('Windows NT 7.0', 'Windows 7');
    $ros[] = array('Windows CE', 'Windows CE');
    $ros[] = array('(media center pc).([0-9]{1,2}\.[0-9]{1,2})', 'Windows Media Center');
    $ros[] = array('(win)([0-9]{1,2}\.[0-9x]{1,2})', 'Windows');
    $ros[] = array('(win)([0-9]{2})', 'Windows');
    $ros[] = array('(windows)([0-9x]{2})', 'Windows');
    // Doesn't seem like these are necessary...not totally sure though..
    //$ros[] = array('(winnt)([0-9]{1,2}\.[0-9]{1,2}){0,1}', 'Windows NT');
    //$ros[] = array('(windows nt)(([0-9]{1,2}\.[0-9]{1,2}){0,1})', 'Windows NT'); // fix by bg
    $ros[] = array('Windows ME', 'Windows ME');
    $ros[] = array('Win 9x 4.90', 'Windows ME');
    $ros[] = array('Windows 98|Win98', 'Windows 98');
    $ros[] = array('Windows 95', 'Windows 95');
    $ros[] = array('(windows)([0-9]{1,2}\.[0-9]{1,2})', 'Windows');
    $ros[] = array('win32', 'Windows');
    $ros[] = array('(java)([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,2})', 'Java');
    $ros[] = array('(Solaris)([0-9]{1,2}\.[0-9x]{1,2}){0,1}', 'Solaris');
    $ros[] = array('dos x86', 'DOS');
    $ros[] = array('unix', 'Unix');
    $ros[] = array('Mac OS X', 'Mac OS X');
    $ros[] = array('Mac_PowerPC', 'Macintosh PowerPC');
    $ros[] = array('(mac|Macintosh)', 'Mac OS');
    $ros[] = array('(sunos)([0-9]{1,2}\.[0-9]{1,2}){0,1}', 'SunOS');
    $ros[] = array('(beos)([0-9]{1,2}\.[0-9]{1,2}){0,1}', 'BeOS');
    $ros[] = array('(risc os)([0-9]{1,2}\.[0-9]{1,2})', 'RISC OS');
    $ros[] = array('os/2', 'OS/2');
    $ros[] = array('freebsd', 'FreeBSD');
    $ros[] = array('openbsd', 'OpenBSD');
    $ros[] = array('netbsd', 'NetBSD');
    $ros[] = array('irix', 'IRIX');
    $ros[] = array('plan9', 'Plan9');
    $ros[] = array('osf', 'OSF');
    $ros[] = array('aix', 'AIX');
    $ros[] = array('GNU Hurd', 'GNU Hurd');
    $ros[] = array('(fedora)', 'Linux - Fedora');
    $ros[] = array('(kubuntu)', 'Linux - Kubuntu');
    $ros[] = array('(ubuntu)', 'Linux - Ubuntu');
    $ros[] = array('(debian)', 'Linux - Debian');
    $ros[] = array('(CentOS)', 'Linux - CentOS');
    $ros[] = array('(Mandriva).([0-9]{1,3}(\.[0-9]{1,3})?(\.[0-9]{1,3})?)', 'Linux - Mandriva');
    $ros[] = array('(SUSE).([0-9]{1,3}(\.[0-9]{1,3})?(\.[0-9]{1,3})?)', 'Linux - SUSE');
    $ros[] = array('(Dropline)', 'Linux - Slackware (Dropline GNOME)');
    $ros[] = array('(ASPLinux)', 'Linux - ASPLinux');
    $ros[] = array('(Red Hat)', 'Linux - Red Hat');
    // Loads of Linux machines will be detected as unix.
    // Actually, all of the linux machines I've checked have the 'X11' in the User Agent.
    //$ros[] = array('X11', 'Unix');
    $ros[] = array('(linux)', 'Linux');
    $ros[] = array('(amigaos)([0-9]{1,2}\.[0-9]{1,2})', 'AmigaOS');
    $ros[] = array('amiga-aweb', 'AmigaOS');
    $ros[] = array('amiga', 'Amiga');
    $ros[] = array('AvantGo', 'PalmOS');
    //$ros[] = array('(Linux)([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,3}(rel\.[0-9]{1,2}){0,1}-([0-9]{1,2}) i([0-9]{1})86){1}', 'Linux');
    //$ros[] = array('(Linux)([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,3}(rel\.[0-9]{1,2}){0,1} i([0-9]{1}86)){1}', 'Linux');
    //$ros[] = array('(Linux)([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,3}(rel\.[0-9]{1,2}){0,1})', 'Linux');
    $ros[] = array('[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,3})', 'Linux');
    $ros[] = array('(webtv)/([0-9]{1,2}\.[0-9]{1,2})', 'WebTV');
    $ros[] = array('Dreamcast', 'Dreamcast OS');
    $ros[] = array('GetRight', 'Windows');
    $ros[] = array('go!zilla', 'Windows');
    $ros[] = array('gozilla', 'Windows');
    $ros[] = array('gulliver', 'Windows');
    $ros[] = array('ia archiver', 'Windows');
    $ros[] = array('NetPositive', 'Windows');
    $ros[] = array('mass downloader', 'Windows');
    $ros[] = array('microsoft', 'Windows');
    $ros[] = array('offline explorer', 'Windows');
    $ros[] = array('teleport', 'Windows');
    $ros[] = array('web downloader', 'Windows');
    $ros[] = array('webcapture', 'Windows');
    $ros[] = array('webcollage', 'Windows');
    $ros[] = array('webcopier', 'Windows');
    $ros[] = array('webstripper', 'Windows');
    $ros[] = array('webzip', 'Windows');
    $ros[] = array('wget', 'Windows');
    $ros[] = array('Java', 'Unknown');
    $ros[] = array('flashget', 'Windows');
    // delete next line if the script show not the right OS
    //$ros[] = array('(PHP)/([0-9]{1,2}.[0-9]{1,2})', 'PHP');
    $ros[] = array('MS FrontPage', 'Windows');
    $ros[] = array('(msproxy)/([0-9]{1,2}.[0-9]{1,2})', 'Windows');
    $ros[] = array('(msie)([0-9]{1,2}.[0-9]{1,2})', 'Windows');
    $ros[] = array('libwww-perl', 'Unix');
    $ros[] = array('UP.Browser', 'Windows CE');
    $ros[] = array('NetAnts', 'Windows');
    $file = count ( $ros );
    $os = '';
    for ( $n=0 ; $n<$file ; $n++ ){
        if ( preg_match('/'.$ros[$n][0].'/i' , $agent, $name)){
            $os = @$ros[$n][1].' '.@$name[2];
            break;
        }
    }
    return trim ( $os );
  }

  public function serverOSInfo() {

    $rez = "";
    echo php_uname()."\n";
    echo PHP_OS."\n";
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
      $rez = 'OS: Windows platform';
    } else {
      $rez = 'Other'."\n";
    }

    return $rez;
  }

  public function phpInfo() {
    return phpinfo();
  }

  public function linuxInfo() {

    system("uptime");
    system("uname -a");
    system("free -m");
    system("df -h");
    system("cat /proc/cpuinfo | grep \"model name\\|processor\"");

  }

}
