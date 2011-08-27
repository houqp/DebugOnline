.PHONY:clean all run compile

all:compile
	
run:compile
	./bin > run_output > run_output

compile:
	gcc -o bin -O0 -g *.c 2> compile_output

gdb:compile
	test -b gdb_output_raw || touch gdb_output_raw
	mv gdb_output_raw gdb_output_raw.old
	gdb -x gdb_commands --batch bin > gdb_output_raw
	./catnew.sh gdb_output_raw.old gdb_output_raw >gdb_output

clean:
	rm -rf bin gdb_output* compile_output run_output

