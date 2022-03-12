<?php

namespace Reiko\Libraries;

class Curl
{
    private $option = array();
    private $headers = array();
    private $settings = array();
    private $curl;
    private $curlopt;

    public function __construct()
    {
        $this->curl = curl_init();
    }

    public function settings($settings)
    {
        $this->settings = $settings;
    }

    public function setUrl($url)
    {
        $this->setOpt(CURLOPT_URL, $url);
    }

    public function setRef($ref)
    {
        $this->setOpt(CURLOPT_REFERER, $ref);
    }

    public function setFollow($bool = true)
    {
        $this->setOpt(CURLOPT_FOLLOWLOCATION, $bool);
    }

    public function setHeader($bool = true)
    {
        $this->setOpt(CURLOPT_HEADER, $bool);
    }

    public function setTransfer($bool = true)
    {
        $this->setOpt(CURLOPT_RETURNTRANSFER, $bool);
    }

    public function setUserAgent($ua)
    {
        $this->setOpt(CURLOPT_USERAGENT, $ua);
    }

    public function setVerifyHost($options)
    {
        $this->setOpt(CURLOPT_SSL_VERIFYHOST, $options);
    }

    public function setVerifyPeer($bool = false)
    {
        $this->setOpt(CURLOPT_SSL_VERIFYPEER, $bool);
    }

    public function setNobody($bool = false)
    {
        $this->setOpt(CURLOPT_NOBODY, $bool);
    }

    public function setCookie($cookies)
    {
        $this->setOpt(CURLOPT_COOKIE, $cookies);
    }

    public function setCookieJar($cookies)
    {
        $this->setOpt(CURLOPT_COOKIEJAR, $cookies);
    }

    public function setCookieFile($cookies)
    {
        $this->setOpt(CURLOPT_COOKIEFILE, $cookies);
    }

    public function setCTO($time)
    {
        $this->setOpt(CURLOPT_CONNECTTIMEOUT, $time);
    }

    public function setEncoding($encode)
    {
        $this->setOpt(CURLOPT_ENCODING, $encode);
    }

    public function setSocks5($socks)
    {
        $this->setOpt(CURLOPT_HTTPPROXYTUNNEL, true);
        $this->setOpt(CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
        $this->setOpt(CURLOPT_PROXY, $socks);
    }

    public function setPost($data)
    {
        $this->setOpt(CURLOPT_POSTFIELDS, $data);
        $this->setOpt(CURLOPT_POST, true);
    }

    public function setCustomReq($req, $data = array())
    {
        $this->setOpt(CURLOPT_CUSTOMREQUEST, $req);
        if (isset($data)) {
            $this->setOpt(CURLOPT_POSTFIELDS, $data);
        }
    }

    public function setHeaderOneHit($headers)
    {
        $this->setOpt(CURLOPT_HTTPHEADER, $headers);
    }

    public function setHeaderOrigin($origin)
    {
        $this->headers['origin'] = $origin;
    }

    public function setHeaderAccept($accept)
    {
        $this->headers['Accept'] = $accept;
    }

    public function setHeaderLang($lang)
    {
        $this->headers['Accept-Language'] = $lang;
    }

    public function setHeaderEncode($encode)
    {
        $this->headers['Accept-Encoding'] = $encode;
    }

    public function setHeaderExtraHeader($headername, $headervalue)
    {
        $this->headers[$headername] = $headervalue;
    }

    public function setHeaderHost($host)
    {
        $this->headers['Host'] = $host;
    }

    public function setHeaderContentType($content)
    {
        $this->headers['Content-Type'] = $content;
    }

    public function setHeaderCookie($cookie)
    {
        $this->headers['Cookie'] = $cookie;
    }

    public function setHeaderConnection($connection)
    {
        $this->headers['Connection'] = $connection;
    }

    public function buildHeader()
    {
        $headers = array();
        foreach ($this->headers as $key => $value) {
            $headers[] = $key . ": " . $value;
        }

        $this->setHeaderOneHit($headers);
    }

    public function setOpt($options, $value)
    {
        $this->options[$options] = $value;
    }

    public function buildOpt()
    {
        $this->curlopt = curl_setopt_array($this->curl, $this->options);
    }

    public function exec()
    {
        $response = curl_exec($this->curl);

        return $response;
    }

    public function getInfo($option = "")
    {
        $info = curl_getinfo($this->curl, $option);
        return $info;
    }

    /*
	@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
	@												   @
	@	To get response header you must enable Header  @
	@												   @
	@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
	*/

    public function getHeaderResponse()
    {
        $header = substr($this->exec(), 0, $this->getInfo(CURLINFO_HEADER_SIZE));

        return $header;
    }

    public function getBodyResponse()
    {
        $body = substr($this->exec(), $this->getInfo(CURLINFO_HEADER_SIZE));

        return $body;
    }

    public function close()
    {
        curl_close($this->curl);
    }

    public function buildHttpPost($data = array())
    {
        $data = http_build_query($data);

        return $data;
    }

    public function buildJsonPost($data = array())
    {
        $data = json_encode($data);

        return $data;
    }

    public function curl()
    {
        if (isset($this->settings['url'])) {
            $this->setUrl($this->settings['url']);
        } else {
            throw new \Exception("The URL paramater couldn't be empty");
        }

        if (isset($this->settings['url_ref'])) {
            $this->setRef($this->settings['url_ref']);
        }

        if (isset($this->settings['useragent'])) {
            $this->setUserAgent($this->settings['useragent']);
        }

        if (isset($this->settings['follow_location'])) {
            $this->setFollow($this->settings['follow_location']);
        }

        if (isset($this->settings['return_transfer'])) {
            $this->setTransfer($this->settings['return_transfer']);
        }

        if (isset($this->settings['header'])) {
            $this->setHeader($this->settings['header']);
        }

        if (isset($this->settings['cookie_string'])) {
            $this->setCookie($this->settings['cookie_string']);
        }

        if (isset($this->settings['cookie_jar'])) {
            $this->setCookieJar($this->settings['cookie_jar']);
        }

        if (isset($this->settings['cookie_file'])) {
            $this->setCookieFile($this->settings['cookie_file']);
        }

        if (isset($this->settings['socks5'])) {
            $this->setSocks5($this->settings['socks5']);
        }

        if (isset($this->settings['http_headers'])) {
            $this->setHeaderOneHit($this->settings['http_header']);
        }

        if (isset($this->settings['header_builder'])) {
            if (isset($this->settings['header_builder']['host'])) {
                $this->setHeaderHost($this->settings['header_builder']['host']);
            }

            if (isset($this->settings['header_builder']['accept'])) {
                $this->setHeaderAccept($this->settings['header_builder']['accept']);
            }

            if (isset($this->settings['header_builder']['accept_lang'])) {
                $this->setHeaderLang($this->settings['header_builder']['accept_lang']);
            }

            if (isset($this->settings['header_builder']['content_type'])) {
                $this->setHeaderContentType($this->settings['header_builder']['content_type']);
            }

            if (isset($this->settings['header_builder']['connection'])) {
                $this->setHeaderConnection($this->settings['header_builder']['connection']);
            }

            if (isset($this->settings['header_builder']['encoding'])) {
                $this->setHeaderEncode($this->settings['header_builder']['encoding']);
            }

            if (isset($this->settings['header_builder']['extra_header'])) {
                foreach ($this->settings['header_builder']['extra_header'] as $key => $value) {
                    $this->setHeaderExtraHeader($key, $value);
                }
            }

            $this->buildHeader();
        }

        if (isset($this->settings['nobody'])) {
            $this->setNobody($this->settings['nobody']);
        }

        if (isset($this->settings['timeout'])) {
            $this->setCTO($this->settings['timeout']);
        }

        if (isset($this->settings['verify_host'])) {
            $this->setVerifyHost($this->settings['verify_host']);
        }

        if (isset($this->settings['verify_peer'])) {
            $this->setVerifyPeer($this->settings['verify_peer']);
        }

        if (isset($this->settings['post'])) {
            $this->setPost($this->settings['post']);
        }

        if (isset($this->settings['custom_req']['type'])) {
            if (isset($this->settings['custom_req']['data'])) {
                $data = $this->settings['custom_req']['data'];
            } else {
                $data = null;
            }
            $this->setCustomReq($this->settings['custom_req']['type'], $data);
        }

        $this->buildOpt();
        $response = $this->exec();

        if (isset($this->settings['body_only']) && $this->settings['body_only'] = true) {
            $response = $this->getBodyResponse();
        }

        if (isset($this->settings['header_only']) && $this->settings['header_only'] = true) {
            $response = $this->getHeaderResponse();
        }

        return $response;
    }
}
