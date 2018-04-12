package gcop.config;

public class Type {

    private String[] types;

    public Type(){

        this.types = new String[]{
                "-XX:+UseSerialGC",
                "-XX:+UseParallelGC",
                "-XX:+UseParallelOldGC",
                "-XX:+UseConcMarkSweepGC",
                "-XX:+UseParNewGC",
                "-XX:+CMSParallelRemarkEnabled",
                "-XX:+UseCMSInitiatingOccupancyOnly",
                "-XX:+UseG1GC"
        };

    }

    public String[] getTypes() {
        return this.types;
    }
}
