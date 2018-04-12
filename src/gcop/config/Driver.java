package gcop.config;

import java.io.IOException;
import java.util.*;
import java.lang.ProcessBuilder;
import java.lang.Process;
import java.util.concurrent.ExecutionException;

public class Driver {

    public Driver(){

        Type type = new Type();
        Flags flag = new Flags();

        String[] types = type.getTypes();
        List<Flag> flags = flag.getFlagList();

        String cmd = "";
        String selectedType = "";

        int itFlag = 0;

        //Start Iterations
        for(int i = 0; i < types.length; i++){

            selectedType = types[i];

            for(int j = 0; j < flags.size(); j++){

                do {
                    cmd = "java " + selectedType;
                    cmd += " " + flags.get(j).getName() + "=" + flags.get(j).getVal();
                    cmd += " -jar benchmarks/SPECjvm2008/SPECjvm2008.jar -ikv";

                    try {
                        ProcessBuilder pb = new ProcessBuilder("java", selectedType, "-jar benchmarks/SPECjvm2008/SPECjvm2008.jar", "-ikv", "startup.helloworld");
                        Process p = pb.start();
                        System.out.println("PROCESS");

                        try{
                            p.waitFor();
                        }catch(Exception d){
                            d.printStackTrace();
                        }

                    }catch(IOException e){
                        e.printStackTrace();
                    }

                    itFlag++;

                    //run cmd
                    System.out.println(cmd);

                }while(flags.get(j).next());

                flags.get(j).reset();

            }


        }

        System.out.println(itFlag);

    }

    public static void main(String args[]){
        new Driver();
    }
}
