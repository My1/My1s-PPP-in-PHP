# My1s-PPP-in-PHP
a PHP Library for Perfect paper Passwords ( https://www.grc.com/ppp )

This class uses the biginteger library from http://phpseclib.sourceforge.net/math/intro.html
as well as the template Files from https://www.grc.com/ppp/pppexe.htm

the ppp.php file (The PPP Implementation) is something I wrote myself by using the algorithm documented under https://www.grc.com/ppp/algorithm.htm

Therefore the ppp.php file is Subject to [My1's Open-Source License](https://github.com/My1/My1-OSL/blob/master/My1-OSL.md)

The only sad thing is that my testing key `776f76656e2e696e7365742e686f6f6b732e70726f75642e646b2e736e616b65` doesnt generate the same keys as the [reference](https://www.grc.com/ppp?1=776f76656e2e696e7365742e686f6f6b732e70726f75642e646b2e736e616b65&5=My1%20PPP%20testing) so HELP is appreciated.
