package gcop.config;

public class Type {

    private String[] types;

    public Type(){

        this.types = new String[]{
                "UseSerialGC",
                "UseParallelGC",
                "UseParallelOldGC",
                "UseConcMarkSweepGC",
                "UseParNewGC",
                "CMSParallelRemarkEnabled",
                "UseCMSInitiatingOccupancyOnly",
                "UseG1GC"
        };

    }

    public String[] getTypes() {
        return this.types;
    }
}
