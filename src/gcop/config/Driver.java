package gcop.config;

import java.io.IOException;
import java.util.*;
import java.lang.ProcessBuilder;
import java.lang.Process;
import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.util.concurrent.ExecutionException;

public class Driver {

    public Driver(){

        Type type = new Type();


        String[] types = type.getTypes();


        //Start Iterations
        for(int i = 0; i < types.length; i++){

            List<String> cmd = new ArrayList<>();

            cmd.add("java");
            cmd.add("-XX:+" + types[i]);
            cmd.add("-XX:+PrintGCTimeStamps");
            cmd.add("-XX:+PrintGCDetails");
            cmd.add("-Xloggc:results/gc/" + types[i] + "_" + "startup.helloworld.txt");
            cmd.add("-jar");
            cmd.add("SPECjvm2008.jar");
            cmd.add("startup.helloworld");

            System.out.println(cmd);

            ProcessBuilder pb = new ProcessBuilder(cmd);
            try {
                Process p = pb.start();
                BufferedReader in = new BufferedReader(new InputStreamReader(p.getInputStream()));
                String s = "";
                while((s = in.readLine()) != null){
                    System.out.println(s);
                }
                int status = p.waitFor();
                System.out.println("Exited with status: " + status);
            }catch(IOException e){
                e.printStackTrace();
            }catch(InterruptedException ee){
                ee.printStackTrace();
            }

        }

    }

    public static void main(String args[]){
        new Driver();
    }
}
