.PHONY:clean all run compile

all:compile
	
compile:
	gcc -o bin -O0 -g *.c > compile_output

run:
	./bin > run_output > run_output

gdb:
	gdb -x gdb_commands bin > gdb_output
