<?php

/**
 * @method   fgc
 * @todo alias of file_get_contents
 */
function fgc($file)
{
    return file_get_contents($file);
}

/**
 * @method fpc
 * @todo  alias of file_put_contents
 */
function fpc($file, $content)
{
    return file_put_contents($file, $content);
}

function get_file_info(string $file, $returnedValues = ['name', 'server_path', 'size', 'date'])
{
    if (!is_file($file)) {
        return null;
    }

    $fileInfo = [];

    if (is_string($returnedValues)) {
        $returnedValues = explode(',', $returnedValues);
    }

    foreach ($returnedValues as $key) {
        switch ($key) {
            case 'name':
                $fileInfo['name'] = basename($file);
                break;

            case 'server_path':
                $fileInfo['server_path'] = $file;
                break;

            case 'size':
                $fileInfo['size'] = filesize($file);
                break;

            case 'date':
                $fileInfo['date'] = filemtime($file);
                break;

            case 'readable':
                $fileInfo['readable'] = is_readable($file);
                break;

            case 'writable':
                $fileInfo['writable'] = is_writable($file);
                break;

            case 'executable':
                $fileInfo['executable'] = is_executable($file);
                break;

            case 'fileperms':
                $fileInfo['fileperms'] = fileperms($file);
                break;
        }
    }

    return $fileInfo;
}

function symbolic_permissions(int $perms)
{
    if (($perms & 0xC000) === 0xC000) {
        $symbolic = 's'; // Socket
    } elseif (($perms & 0xA000) === 0xA000) {
        $symbolic = 'l'; // Symbolic Link
    } elseif (($perms & 0x8000) === 0x8000) {
        $symbolic = '-'; // Regular
    } elseif (($perms & 0x6000) === 0x6000) {
        $symbolic = 'b'; // Block special
    } elseif (($perms & 0x4000) === 0x4000) {
        $symbolic = 'd'; // Directory
    } elseif (($perms & 0x2000) === 0x2000) {
        $symbolic = 'c'; // Character special
    } elseif (($perms & 0x1000) === 0x1000) {
        $symbolic = 'p'; // FIFO pipe
    } else {
        $symbolic = 'u'; // Unknown
    }

    // Owner
    $symbolic .= (($perms & 0x0100) ? 'r' : '-')
        . (($perms & 0x0080) ? 'w' : '-')
        . (($perms & 0x0040) ? (($perms & 0x0800) ? 's' : 'x') : (($perms & 0x0800) ? 'S' : '-'));

    // Group
    $symbolic .= (($perms & 0x0020) ? 'r' : '-')
        . (($perms & 0x0010) ? 'w' : '-')
        . (($perms & 0x0008) ? (($perms & 0x0400) ? 's' : 'x') : (($perms & 0x0400) ? 'S' : '-'));

    // World
    $symbolic .= (($perms & 0x0004) ? 'r' : '-')
        . (($perms & 0x0002) ? 'w' : '-')
        . (($perms & 0x0001) ? (($perms & 0x0200) ? 't' : 'x') : (($perms & 0x0200) ? 'T' : '-'));

    return $symbolic;
}
