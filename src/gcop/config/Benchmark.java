package gcop.config;

public class Benchmark {

    private String[] benchmarks;

    public Benchmark(){
        this.benchmarks = new String[]{
                "startup.helloworld",
                "startup.compiler.compiler",
                "startup.compiler.sunflow",
                "startup.compress",
                "startup.crypto.aes",
                "startup.crypto.rsa",
                "startup.crypto.signverify",
                "startup.mpegaudio",
                "startup.scimark.fft",
                "startup.scimark.lu",
                "startup.scimark.monte_carlo",
                "startup.scimark.sor",
                "startup.scimark.sparse",
                "startup.serial",
                "startup.sunflow",
                "startup.xml.transform",
                "startup.xml.validation",
                "compiler.compiler",
                "compiler.sunflow",
                "compress",
                "crypto.aes",
                "crypto.rsa",
                "crypto.signverify",
                "derby",
                "mpegaudio",
                "scimark.fft.large",
                "scimark.lu.large",
                "scimark.sor.large",
                "scimark.sparse.large",
                "scimark.fft.small",
                "scimark.lu.small",
                "scimark.sor.small",
                "scimark.sparse.small",
                "scimark.monte_carlo",
                "serial",
                "sunflow",
                "xml.transform",
                "xml.validation"
        };
    }

    public String[] getList(){
        return this.benchmarks;
    }

}
