package gcop.config;

import java.io.IOException;
import java.util.*;
import java.lang.ProcessBuilder;
import java.lang.Process;
import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.util.concurrent.ExecutionException;
import org.json.simple.JSONObject;
import org.json.simple.JSONArray;
import org.json.simple.*;
import org.json.simple.parser.JSONParser;
import org.json.simple.parser.ParseException;

public class Driver {

    public Driver(){

        Type type = new Type();
        Benchmark benchmark = new Benchmark();


        String[] types = type.getTypes();
        String[] benchmarks = benchmark.getList();

        JSONParser parser = new JSONParser();
        JSONObject jsonObj = null;
        try {
             jsonObj = (JSONObject) parser.parse("{\"CMSParallelRemarkEnabled\":{\"compiler.compiler\":\"1839870\",\"compress\":\"386387\",\"crypto.aes\":\"695454\",\"crypto.rsa\":\"106415\",\"crypto.signverify\":\"201067\",\"derby\":\"1102401\",\"mpegaudio\":\"102771\",\"scimark.fft.large\":\"1412360\",\"scimark.fft.small\":\"140945\",\"scimark.lu.large\":\"1298847\",\"scimark.lu.small\":\"666118\",\"scimark.monte_carlo\":\"36393\",\"scimark.sor.large\":\"280773\",\"scimark.sor.small\":\"42482\",\"scimark.sparse.large\":\"1066013\",\"scimark.sparse.small\":\"91869\",\"serial\":\"938987\",\"startup.compiler.compiler\":\"34889\",\"startup.compress\":\"34889\",\"startup.crypto.aes\":\"34889\",\"startup.crypto.rsa\":\"34889\",\"startup.crypto.signverify\":\"34889\",\"startup.helloworld\":\"34889\",\"startup.mpegaudio\":\"34889\",\"startup.scimark.fft\":\"34889\",\"startup.scimark.lu\":\"34889\",\"startup.scimark.monte_carlo\":\"34889\",\"startup.scimark.sor\":\"34889\",\"startup.scimark.sparse\":\"34889\",\"startup.serial\":\"34889\",\"startup.xml.transform\":\"34889\",\"startup.xml.validation\":\"34889\",\"xml.transform\":\"735081\",\"xml.validation\":\"1656958\"},\"UseCMSInitiatingOccupancyOnly\":{\"compiler.compiler\":\"1829117\",\"compress\":\"342462\",\"crypto.aes\":\"703688\",\"crypto.rsa\":\"106478\",\"crypto.signverify\":\"215032\",\"derby\":\"1109714\",\"mpegaudio\":\"101127\",\"scimark.fft.large\":\"1412344\",\"scimark.fft.small\":\"141920\",\"scimark.lu.large\":\"1096523\",\"scimark.lu.small\":\"663818\",\"scimark.monte_carlo\":\"35385\",\"scimark.sor.large\":\"280811\",\"scimark.sor.small\":\"42384\",\"scimark.sparse.large\":\"1085211\",\"scimark.sparse.small\":\"98744\",\"serial\":\"929118\",\"startup.compiler.compiler\":\"34889\",\"startup.compress\":\"34889\",\"startup.crypto.aes\":\"34889\",\"startup.crypto.rsa\":\"34889\",\"startup.crypto.signverify\":\"34889\",\"startup.helloworld\":\"34889\",\"startup.mpegaudio\":\"34889\",\"startup.scimark.fft\":\"34889\",\"startup.scimark.lu\":\"34889\",\"startup.scimark.monte_carlo\":\"34889\",\"startup.scimark.sor\":\"34889\",\"startup.scimark.sparse\":\"34889\",\"startup.serial\":\"34889\",\"startup.xml.transform\":\"34889\",\"startup.xml.validation\":\"34889\",\"xml.transform\":\"734185\",\"xml.validation\":\"1633231\"},\"UseConcMarkSweepGC\":{\"compiler.compiler\":\"1631955\",\"compress\":\"152143\",\"crypto.aes\":\"1199153\",\"crypto.rsa\":\"38882\",\"crypto.signverify\":\"553952\",\"derby\":\"658842\",\"mpegaudio\":\"111406\",\"scimark.fft.large\":\"855318\",\"scimark.fft.small\":\"112755\",\"scimark.lu.large\":\"1251515\",\"scimark.lu.small\":\"753242\",\"scimark.monte_carlo\":\"37203\",\"scimark.sor.large\":\"524949\",\"scimark.sor.small\":\"47574\",\"scimark.sparse.large\":\"987157\",\"scimark.sparse.small\":\"42740\",\"serial\":\"432293\",\"startup.compiler.compiler\":\"36585\",\"startup.compress\":\"36585\",\"startup.crypto.aes\":\"36585\",\"startup.crypto.rsa\":\"36585\",\"startup.crypto.signverify\":\"36585\",\"startup.helloworld\":\"36585\",\"startup.mpegaudio\":\"36584\",\"startup.scimark.fft\":\"36585\",\"startup.scimark.lu\":\"36585\",\"startup.scimark.monte_carlo\":\"36585\",\"startup.scimark.sor\":\"36585\",\"startup.scimark.sparse\":\"36585\",\"startup.serial\":\"36585\",\"startup.xml.transform\":\"36585\",\"startup.xml.validation\":\"36585\",\"xml.transform\":\"114840\",\"xml.validation\":\"309784\"},\"UseG1GC\":{\"compiler.compiler\":1640000,\"compress\":99600,\"crypto.aes\":1362200,\"crypto.rsa\":32299.999999999996,\"crypto.signverify\":1025300,\"derby\":1560400,\"mpegaudio\":57000,\"scimark.fft.large\":1861900,\"scimark.fft.small\":982700,\"scimark.lu.large\":1046400.0000000001,\"scimark.lu.small\":153600,\"scimark.monte_carlo\":19900,\"scimark.sor.large\":417500,\"scimark.sor.small\":26400,\"scimark.sparse.large\":1842200,\"scimark.sparse.small\":79100,\"serial\":428900,\"startup.compiler.compiler\":10300,\"startup.compress\":21300,\"startup.crypto.aes\":10400,\"startup.crypto.rsa\":10500,\"startup.crypto.signverify\":\"10229.1\",\"startup.helloworld\":10200,\"startup.mpegaudio\":\"10055.7\",\"startup.scimark.fft\":10600,\"startup.scimark.lu\":10500,\"startup.scimark.monte_carlo\":10500,\"startup.scimark.sor\":\"10234.1\",\"startup.scimark.sparse\":23200,\"startup.serial\":10400,\"startup.xml.transform\":10500,\"startup.xml.validation\":\"10045.8\",\"xml.transform\":277400,\"xml.validation\":1084600},\"UseParNewGC\":{\"compiler.compiler\":\"397816\",\"compress\":\"136989\",\"crypto.aes\":\"120303\",\"crypto.rsa\":\"48922\",\"crypto.signverify\":\"120575\",\"derby\":\"859470\",\"mpegaudio\":\"48111\",\"scimark.fft.large\":\"1182959\",\"scimark.fft.small\":\"119588\",\"scimark.lu.large\":\"1164577\",\"scimark.lu.small\":\"121011\",\"scimark.monte_carlo\":\"37168\",\"scimark.sor.large\":\"496343\",\"scimark.sor.small\":\"49028\",\"scimark.sparse.large\":\"907518\",\"scimark.sparse.small\":\"53667\",\"serial\":\"510798\",\"startup.compiler.compiler\":\"36553\",\"startup.compress\":\"36553\",\"startup.crypto.aes\":\"36553\",\"startup.crypto.rsa\":\"36553\",\"startup.crypto.signverify\":\"36553\",\"startup.helloworld\":\"36553\",\"startup.mpegaudio\":\"36553\",\"startup.scimark.fft\":\"36553\",\"startup.scimark.lu\":\"36553\",\"startup.scimark.monte_carlo\":\"36553\",\"startup.scimark.sor\":\"36553\",\"startup.scimark.sparse\":\"36553\",\"startup.serial\":\"36553\",\"startup.xml.transform\":\"36553\",\"startup.xml.validation\":\"36553\",\"xml.transform\":\"121013\",\"xml.validation\":\"211285\"},\"UseParallelGC\":{\"compiler.compiler\":\"1846782\",\"compress\":\"379121\",\"crypto.aes\":\"680194\",\"crypto.rsa\":\"106366\",\"crypto.signverify\":\"274149\",\"derby\":\"1103555\",\"mpegaudio\":\"99640\",\"scimark.fft.large\":\"1412312\",\"scimark.fft.small\":\"142432\",\"scimark.lu.large\":\"1170014\",\"scimark.lu.small\":\"665830\",\"scimark.monte_carlo\":\"38283\",\"scimark.sor.large\":\"281252\",\"scimark.sor.small\":\"42335\",\"scimark.sparse.large\":\"809424\",\"scimark.sparse.small\":\"102913\",\"serial\":\"940865\",\"startup.compiler.compiler\":\"34889\",\"startup.compress\":\"34889\",\"startup.crypto.aes\":\"34889\",\"startup.crypto.rsa\":\"34889\",\"startup.crypto.signverify\":\"34889\",\"startup.helloworld\":\"34889\",\"startup.mpegaudio\":\"34889\",\"startup.scimark.fft\":\"34889\",\"startup.scimark.lu\":\"34889\",\"startup.scimark.monte_carlo\":\"34889\",\"startup.scimark.sor\":\"34889\",\"startup.scimark.sparse\":\"34889\",\"startup.serial\":\"34889\",\"startup.xml.transform\":\"34889\",\"startup.xml.validation\":\"34889\",\"xml.transform\":\"733215\",\"xml.validation\":\"1708195\"},\"UseParallelOldGC\":{\"compiler.compiler\":\"1852682\",\"compress\":\"321999\",\"crypto.aes\":\"698372\",\"crypto.rsa\":\"106433\",\"crypto.signverify\":\"194189\",\"derby\":\"1094594\",\"mpegaudio\":\"99288\",\"scimark.fft.large\":\"1411966\",\"scimark.fft.small\":\"140309\",\"scimark.lu.large\":\"1292507\",\"scimark.lu.small\":\"663253\",\"scimark.monte_carlo\":\"36188\",\"scimark.sor.large\":\"280726\",\"scimark.sor.small\":\"42328\",\"scimark.sparse.large\":\"1138248\",\"scimark.sparse.small\":\"94201\",\"serial\":\"972489\",\"startup.compiler.compiler\":\"34889\",\"startup.compress\":\"34889\",\"startup.crypto.aes\":\"34889\",\"startup.crypto.rsa\":\"34889\",\"startup.crypto.signverify\":\"34889\",\"startup.helloworld\":\"34889\",\"startup.mpegaudio\":\"34889\",\"startup.scimark.fft\":\"34889\",\"startup.scimark.lu\":\"34889\",\"startup.scimark.monte_carlo\":\"34889\",\"startup.scimark.sor\":\"34889\",\"startup.scimark.sparse\":\"34889\",\"startup.serial\":\"34889\",\"startup.xml.transform\":\"34889\",\"startup.xml.validation\":\"34889\",\"xml.transform\":\"730625\",\"xml.validation\":\"1672458\"},\"UseSerialGC\":{\"compiler.compiler\":\"408419\",\"compress\":\"137785\",\"crypto.aes\":\"120292\",\"crypto.rsa\":\"42969\",\"crypto.signverify\":\"120422\",\"derby\":\"766161\",\"mpegaudio\":\"39824\",\"scimark.fft.large\":\"1182985\",\"scimark.fft.small\":\"119047\",\"scimark.lu.large\":\"1215208\",\"scimark.lu.small\":\"121003\",\"scimark.monte_carlo\":\"36978\",\"scimark.sor.large\":\"494935\",\"scimark.sor.small\":\"47420\",\"scimark.sparse.large\":\"907583\",\"scimark.sparse.small\":\"52675\",\"serial\":\"481539\",\"startup.compiler.compiler\":\"36553\",\"startup.compress\":\"36553\",\"startup.crypto.aes\":\"36553\",\"startup.crypto.rsa\":\"36553\",\"startup.crypto.signverify\":\"36553\",\"startup.helloworld\":\"36553\",\"startup.mpegaudio\":\"36553\",\"startup.scimark.fft\":\"36553\",\"startup.scimark.lu\":\"36553\",\"startup.scimark.monte_carlo\":\"36553\",\"startup.scimark.sor\":\"36553\",\"startup.scimark.sparse\":\"36553\",\"startup.serial\":\"36553\",\"startup.xml.transform\":\"36553\",\"startup.xml.validation\":\"36553\",\"xml.transform\":\"121012\",\"xml.validation\":\"212713\"}}");
        }catch(ParseException p){
            p.printStackTrace();
        }
        //Start Iterations
        for(int i = 0; i < types.length; i++){
            for(int j = 0; j < benchmarks.length; j++) {

                JSONObject ben = (JSONObject) jsonObj.get(types[i]);
                //System.out.println(types[i] + " " + benchmarks[j] + ":  " + (int)Double.parseDouble(ben.get(benchmarks[j]).toString()));

               List<String> cmd = new ArrayList<>();

                cmd.add("java");
                cmd.add("-XX:+" + types[i]);
                cmd.add("-XX:+PrintGCTimeStamps");
                cmd.add("-XX:+PrintGCDetails");
                cmd.add("-XX:+PrintGCApplicationStoppedTime");
                cmd.add("-XX:+PrintGCApplicationConcurrentTime");

                //these change based on the type of run
                cmd.add("-XX:-UseAdaptiveSizePolicy");
                //JSONObject ben = (JSONObject) jsonObj.get(types[i]);
                cmd.add("-Xmx" + ((int)Double.parseDouble(ben.get(benchmarks[j]).toString()) / 2) + "k");
                cmd.add("-Xms" + ((int)Double.parseDouble(ben.get(benchmarks[j]).toString()) / 2) + "k");

                cmd.add("-Xloggc:results/gc/" + types[i] + "_" + benchmarks[j]);
                cmd.add("-jar");
                cmd.add("SPECjvm2008.jar");
                cmd.add(benchmarks[j]);

                System.out.println(cmd);

                /*ProcessBuilder pb = new ProcessBuilder(cmd);
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
                }*/
            }

        }

    }

    public static void main(String args[]){
        new Driver();
    }
}
