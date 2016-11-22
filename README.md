# My1s-PPP-in-PHP
a PHP Library for Perfect paper Passwords ( https://www.grc.com/ppp )

This class uses the biginteger library from http://phpseclib.sourceforge.net/math/intro.html
as well as the template Files from https://www.grc.com/ppp/pppexe.htm

the ppp.php file (The PPP Implementation) and the ppp-rev.php file (the reversal of a PPP to it's initial Dividend) is something I wrote myself by using the algorithm documented under https://www.grc.com/ppp/algorithm.htm

Therefore the ppp.php as well as the ppp-rev.php file is Subject to [My1's Open-Source License](https://github.com/My1/My1-OSL/blob/master/My1-OSL.md)

The only sad thing is that my testing key `776f76656e2e696e7365742e686f6f6b732e70726f75642e646b2e736e616b65` doesnt generate the same keys as the [reference](https://www.grc.com/ppp?1=776f76656e2e696e7365742e686f6f6b732e70726f75642e646b2e736e616b65&5=My1%20PPP%20testing) so HELP is appreciated.

Update (22.11.2016) I added a file which allows reversing the PPP (provided it's long enough to cointain the full number) to the initial dividend. based on that (and a test whether that thing works to properly generate the PPP) I found out that the PPP generation itself is right, the only problem relies in the encryption of the sequence Key, which according to the algo has a 128 bit counter as the plaintext and the sequence key and the encryption key. Considering that PPP is highly deterministic, EBC is the only AES key that actually makes sense, because randomizing an IV will obviously change the encryption result which is pretty much NOT what we want.

Aside from that I "hand-run" all the crypto and Math steps in web tools (Thanks to wolframalpha for the divisions) and then checked the character map by myself and I am confident that the algo I wrote matches the one described on their page, even though it doesn't seem to be matching with the code.

Maybe they changed something in the algo and didnt write it into the docs, I don't know that far.
