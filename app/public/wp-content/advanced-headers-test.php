<?php
/**
* This file is created by Really Simple SSL to test the CSP header length
* It will not load during regular wordpress execution
*/


if ( !headers_sent() ) {
header("X-REALLY-SIMPLE-SSL-TEST: %2B%8Ca%CF%AC%81%FCG%C1%D6%5C%21%EA%26%AB%E9%86%B9%03%5C%F2%ACv%12q%8F+s%BCMPn%40%85%19%B6%E1%A0%CEQ%D3%CFZ%E5%EC%B9%B6j%5CN%2A%D7%BD%EC%A4%D4R_%9CgK%0A%3F%19%D0%C8z%E3%0AEX%9C%B3v%2C%E1%89%5C%1C%F5%DC%09Z%04%DA%10%23%16%3C%9F%1E%FA%8D%B9%E7%2C%0Fd%A6%21%82%F6V%96.D%5C%B2%A3%5C%82J%A8%17%85%40%B3%DE%08u%A6W%C5%99%8CTF%80D%2Af%F8%82%C4%AF%8F%AF%CF%E4%DB%40%0A%88%A3%DC%C6O%C8%B9%A9%7C%01%E4%AC%F5%E8%1A.%05O%1A%03S5%C2S%9F%9B%13U%EC%EFDn%AEhc%F8%7EIM%D3%9E%95%D7%D3%03DX%16%D4%AA%F7%EA%88%05%BB%F2%B");
}

 echo '<html><head><meta charset="UTF-8"><META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW"></head><body>Really Simple SSL headers test page</body></html>';