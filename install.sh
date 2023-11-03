#!/bin/bash


# QuickCDR install script


if [[ $EUID -ne 0 ]]; then
    echo "Installer must be run as root"
    exit
fi

if [ ! -f '/etc/amportal.conf' ]; then
    echo "FreePBX installation not found, exitting"
    exit
fi


DEST="/var/www/html/quickcdr"
APPUSER="admin"
APPPASS="admin"
APPEMAIL="admin@example.com"


echo "================================================================================"
echo "Welcome to QuickCDR installer!"
echo "This script will guide you through installation process and initial configuration"
echo "================================================================================"
echo ""

echo "Please select install location [$DEST]:"
read USERDEST
if [[ -z $USERDEST ]]; then
    echo "Selected default folder [$DEST]"
elif [ $USERDEST != "$DEST" ]; then
    DEST=$USERDEST
fi
echo "================================================================================"


echo "Enter enter administrative username [$APPUSER]:"
read USERAPPUSER
if [[ -z $USERAPPUSER ]]; then
    echo "Selected default administrative name [$APPUSER]"
elif [ $USERAPPUSER != "$APPUSER" ]; then
    APPUSER=$USERAPPUSER
fi
echo "================================================================================"


echo "Enter enter administrative password [$APPUSER]:"
read USERAPPPASS
if [[ -z $USERAPPPASS ]]; then
    echo "Selected default administrative [$APPPASS]"
elif [ $USERAPPPASS != "$APPPASS" ]; then
    APPPASS=$USERAPPPASS
fi
APPPASS256=`echo -n $APPPASS | sha256sum | gawk '{print $1}'`
echo "================================================================================"


echo ""
echo ""
echo ""
echo "Retrieving FreePBX configuration"
echo "================================================================================"

AMPDBUSER=`cat /etc/freepbx.conf | grep AMPDBUSER | tr '=' ' ' | tr -d '"' | tr -d "'" | tr -d ';' | gawk '{print $2}'`
AMPDBPASS=`cat /etc/freepbx.conf | grep AMPDBPASS | tr '=' ' ' | tr -d '"' | tr -d "'" | tr -d ';' | gawk '{print $2}'`


echo ""
echo "Generating configuration files"
if [ -f 'quickcdr/application/config/database.php.template' ]; then
    cp quickcdr/application/config/database.php.template quickcdr/application/config/database.php
    sed -i "s/AMPDBUSER/${AMPDBUSER}/g" 'quickcdr/application/config/database.php'
    sed -i "s/AMPDBPASS/${AMPDBPASS}/g" 'quickcdr/application/config/database.php'
else
    echo "Could not find database configuration file"
    exit
fi
echo "================================================================================"


echo ""
echo "Creating database schema"
if [ -f 'db/SCHEMA.sql' ]; then
    mysql -u$AMPDBUSER -p$AMPDBPASS asterisk < db/SCHEMA.sql
else
    echo "Could not find database schema"
    exit
fi
echo "================================================================================"


echo ""
echo "Creating administrative account"
mysql -u$AMPDBUSER -p$AMPDBPASS asterisk -e "INSERT INTO qc_users (name,password,role,email) VALUES('$APPUSER', MD5('$APPPASS'), 'admin', 'admin@example.com')"
echo "================================================================================"


echo ""
echo "Linking application files to installation destination"
if [ -d $DEST ]; then
    echo "Folder $DEST already exists."
    echo "To proceed with installation, and overwrite directory contents, type y,"
    echo "otherwise press n, or Ctrl-C to exit and start over"
    echo ""
    echo "Overwrite contents of $DEST? [y/N]"
    read OVERWRITE
    if [[ -z $OVERWRITE ]]; then
        echo "Exitting installer"
        exit
    elif [ $OVERWRITE == 'n' ]; then
        echo "Exitting"
        exit
    elif [ $OVERWRITE != "y" ]; then
        echo "Invalid input, exitting"
        exit
    else
        echo "Overwriting existing installation destination"
        rm -rf $DEST
        /bin/ln $(pwd)/quickcdr/* $DEST/
        echo $DEST > .install_dest
    fi

else
    echo "Linking installation files"
    mkdir -p $DEST
    /bin/ln -s $(pwd)/quickcdr/* $DEST/
    /bin/ln -s $(pwd)/VERSION $DEST/application/VERSION

    echo $DEST > .install_dest
fi
echo "================================================================================"


echo "====== INSTALLATION SUMMARY ===================================================="
echo "|-------------------------------------------------------------------------------"
echo "| Install folder              | $DEST"
echo "|-------------------------------------------------------------------------------"
echo "| Administrative user         | $APPUSER"
echo "|-------------------------------------------------------------------------------"
echo "| Administrative password     | $APPPASS"
echo "|-------------------------------------------------------------------------------"
echo "====== END OF INSTALLATION SUMMARY ============================================="

