#!/bin/bash

help() {
  echo "usage $0 oldfile newfile"
}

if [ $# -ne 2 ];then
  help
  exit 0
fi

old_line_count=`wc -l $1 | awk '{print $1}'`
new_line_count=`wc -l $2 | awk '{print $1}'`
diff_line_count=$(($new_line_count - $old_line_count))
tail -n $diff_line_count $2 > gdb_output

