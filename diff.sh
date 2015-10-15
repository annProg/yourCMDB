#!/bin/bash

############################
# Usage:
# File Name: diff.sh
# Author: annhe  
# Mail: i@annhe.net
# Created Time: 2015-10-14 20:10:45
############################

for id in `diff . /home/wwwroot/yourcmdb/ -qr |grep -v -E '\.git|contrib|\.xml|\.log|test.php|\.bak|diff.sh' |sed 's/ /#/g'`;do
	echo $id
	f=`echo $id |awk -F "#" '{print $4}'`
	t=`echo $id |awk -F "#" '{print $2}'`
	cp -i $f $t
done
