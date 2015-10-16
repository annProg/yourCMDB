#!/bin/bash

############################
# Usage:
# File Name: test-curl.sh
# Author: annhe  
# Mail: i@annhe.net
# Created Time: 2015-10-15 10:13:51
############################

baseUrl="http://repo.annhe.net/yourcmdb/rest.php/"
api="objects"
method="POST"

objectType="\u670d\u52a1\u5668"
objectId="45"
status="A"
fieldGroup="\u670d\u52a1\u5668"
user=api
passwd=api

declare -A fields

fields=(
[hostname]=restlasttest.cnc.proxy.1
[sn]=vm20150101-1
[vendor]=VMware
[mem]=4
[cpu]=8
[IP]=10.0.0.1
[administrator]=10
[product-line]=20
)

len=${#fields[@]}

function getParam()
{
	cnt=1
	for i in ${!fields[@]};do
		fieldkey=$i
		fieldvalue=${fields[$fieldkey]}
		if [ $cnt -lt $len ];then
			str=$str"{\"name\":\"$fieldkey\",\"value\":\"$fieldvalue\"},"
		else
			str=$str"{\"name\":\"$fieldkey\",\"value\":\"$fieldvalue\"}"
		fi
		let cnt+=1
	done
	echo $str
}

function doCheck()
{
	method=$1
	request=$2
	param=$3
	if [ "$param"x != ""x ];then
		curl -s -X $method "$request" -d "$param" -u $user:$passwd -i
	else
		curl -s -X $method "$request" -u $user:$passwd -i
	fi

	echo -e "\n\n========= $method: $request ================"
	echo $param
	echo "==============================================================================="
}

function testPost()
{
	tmpobjectId=0
	method=POST
	request=$baseUrl$api
	if [ $# -ge 2 ];then
		fields[hostname]=$2
	fi
	if [ $# -ge 3 ];then
		fields[sn]=$3
	fi
	str=`getParam`
	param="{\"objectType\":\"$objectType\",\"objectId\":\"$tmpobjectId\",\"status\":\"$status\",\"objectFields\":"
	param=$param"{\"$fieldGroup\":[$str]}}"
	doCheck $method $request $param
}

function testPut()
{
	method=PUT
	if [ $# -ge 1 ];then
		tmpobjectId=$1
	fi
	request="$baseUrl$api/$tmpobjectId"
	if [ $# -ge 2 ];then
		fields[hostname]=$2
	fi
	if [ $# -ge 3 ];then
		fields[sn]=$3
	fi
	str=`getParam`
	param="{\"objectType\":\"$objectType\",\"objectId\":\"$tmpobjectId\",\"status\":\"$status\",\"objectFields\":"
	param=$param"{\"$fieldGroup\":[$str]}}"
	doCheck $method $request $param

}

function testDelete()
{
	method=DELETE
	tmpobjectId=$1
	request="$baseUrl$api/$tmpobjectId"
	param=""
	doCheck $method $request $param

}

function testGet()
{
	method=GET
	tmpobjectId=$1
	request="$baseUrl$api/$tmpobjectId"
	param=""
	doCheck $method $request $param

}

function testGetFields()
{
	method=GET
	tmpobjectId=$1
	tmpapi="objectfields"
	request="$baseUrl$tmpapi/$tmpobjectId"
	param=""
	doCheck $method $request $param

}

function printInfo()
{
	echo -e "\n==================$1====================="
	echo $2
	echo -e "==========================================\n\n"
}

function getInfo()
{
	groups=`curl -s $baseUrl/objecttypes/groups -u $user:$passwd |iconv -f c99 -t utf-8`
	printInfo Object-Groups: $groups
	for id in `echo $groups |tr -s '",[]' ' '`;do
		types=`curl -s $baseUrl/objecttypes/groups/$id -u $user:$passwd |iconv -f c99 -t utf-8`
		printInfo Object-of-$id $types
		for item in `echo $types |tr -s '",[]' ' '`;do
			fieldslist=`curl -s $baseUrl/objectfields/$item -u $user:$passwd |iconv -f c99 -t utf-8`
			printInfo $item $fieldslist
		done
	done
}

if [ $# -eq 0 ];then
	testPost
	testPut
	testGet
	testDelete
else
	case $1 in
		post) testPost $2 $3;;
		put) testPut $2 $3 $4;;
		get) testGet $2;;
		delete) testDelete $2;;
		fields) testGetFields $2;;
		info) getInfo;;
		*) echo "args error" && exit 1;;
	esac
fi
