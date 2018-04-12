package gcop.config;

public class Flag {

    private int min;
    private int max;
    private String name;

    private int it;  //iterator
    private int val; //current value GC is working with

    public Flag(String name, int min, int max, int iterator){
        this.name = name;
        this.min = min;
        this.max = max;
        this.it = iterator;
        this.val = this.min;
    }

    public int getVal(){
        return this.val;
    }

    public String getName(){
        return this.name;
    }

    public boolean next(){
        if(this.val + this.it <= this.max){
            this.val += this.it;
            return true;
        }else{
            return false;
        }
    }

    public void reset(){
        this.val = this.min;
    }

}
