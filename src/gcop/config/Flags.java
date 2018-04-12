package gcop.config;

import java.util.*;

public class Flags {

    private List<Flag> flagList;

    public Flags(){

        //List of Flags used
        flagList = new ArrayList<>();

        flagList.add(new Flag("-XX:NewRatio", 10, 90, 20));


    }

    public List<Flag> getFlagList() {
        return this.flagList;
    }

}
