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
        Benchmark benchmark = new Benchmark();


        String[] types = type.getTypes();
        String[] benchmarks = benchmark.getList();


        //Start Iterations
        for(int i = 0; i < types.length; i++){
            for(int j = 0; j < benchmarks.length; j++) {

                List<String> cmd = new ArrayList<>();

                cmd.add("java");
                cmd.add("-XX:+" + types[i]);
                cmd.add("-XX:+PrintGCTimeStamps");
                cmd.add("-XX:+PrintGCDetails");
                cmd.add("-XX:+PrintGCApplicationStoppedTime");
                cmd.add("-XX:+PrintGCApplicationConcurrentTime");
                cmd.add("-Xloggc:results/gc/" + types[i] + "_" + benchmarks[j]);
                cmd.add("-jar");
                cmd.add("SPECjvm2008.jar");
                cmd.add(benchmarks[j]);

                System.out.println(cmd);

                ProcessBuilder pb = new ProcessBuilder(cmd);
                try {
                    Process p = pb.start();
                    BufferedReader in = new BufferedReader(new InputStreamReader(p.getInputStream()));
                    String s = "";
                    while ((s = in.readLine()) != null) {
                        System.out.println(s);
                    }
                    int status = p.waitFor();
                    System.out.println("Exited with status: " + status);
                } catch (IOException e) {
                    e.printStackTrace();
                } catch (InterruptedException ee) {
                    ee.printStackTrace();
                }
            }

        }

    }

    public static void main(String args[]){
        new Driver();
    }
}
