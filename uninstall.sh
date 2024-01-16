#!/bin/bash


# QuickCDR uninstall script 1


if [[ $EUID -ne 0 ]]; then
    echo "Uninstaller must be run as root"
    exit
fi


if [ ! -f '/etc/amportal.conf' ]; then
    echo "FreePBX installation not fount, exitting"
    exit
fi


echo ""
echo "Removing installation files"
if [ -f .install_dest ];  then
    rm -rf $(cat .install_dest)
else
    echo "Istallation destination can not be found. Please locate and remove QuickCDR files manually."
fi


echo ""
echo "Removing database"
AMPDBUSER=`cat /etc/amportal.conf | grep AMPDBUSER | tr '=' ' '| gawk '{print $2}'`
AMPDBPASS=`cat /etc/amportal.conf | grep AMPDBPASS | tr '=' ' '| gawk '{print $2}'`

mysql -u$AMPDBUSER -p$AMPDBPASS asterisk -e "DROP TABLE qc_users"
mysql -u$AMPDBUSER -p$AMPDBPASS asterisk -e "DROP TABLE qc_user_devices"
mysql -u$AMPDBUSER -p$AMPDBPASS asterisk -e "DROP TABLE qc_device_aliases"

