/*************************************************************************
 *  Compilation:  javac choosineGen.java
 *  Execution:    java choosineGen
 * 
 * Dependencies: Out.java, Digraph.java
 * 
 * Generates an ordering using choices from users.
 * 
 * Author: Kanika Pasricha 
 *
 *************************************************************************/

public class choosineGen{
    public static void main(String[] args){
        int experts = 4;
        int size = 4;
        String s = "choices.txt";
        String ii = "id.txt";
        String p = "rank.txt";
        In states1 = new In(s);
        In id1 = new In(ii);
        In prob1 = new In(p);
        int length = prob1.readInt();
        int[] choices = new int[length];
        for(int i=0;i<length;i++){
            choices[i] = states1.readInt();
        }  
        double[] rank = new double[length];
        for(int i=0;i<length;i++){
           rank[i] = prob1.readDouble();
            }
        
        int[] id = new int[length];
        for(int i =0;i<length;i++){
            id[i] = id1.readInt();
            }
        double[][] freq = new double[size][size];
        for(int k=0;k<length;k++){
            for(int l=k;l<length;l++){
                if((id[k] == id[l]) && (rank[k] < rank [l])){
                    freq[choices[k]][choices[l]]++;
                    
                }
                   if((id[k] == id[l]) && (rank[l] < rank [k])){
                    freq[choices[l]][choices[k]]++;
                    
                }
            }
       } 
                
        // uncertainties for pairwise ranks (to add to DAG)
        Double[] toSort = new Double[size*size];
        Double[] toSortOr = new Double[size*size];
        int counter = 0;
        for(int i=0; i < size; i++){
            for(int j=0; j < size; j++){
                toSort[counter] = freq[j][i] - freq[i][j];
                toSortOr[counter] = freq[j][i] - freq[i][j];
                counter++;
            }
        }
        
        // sorting the uncertainty values mentioned above
        Insertion insertion = new Insertion();
        insertion.sort(toSort);
        
        // the DAG
        Digraph digraph = new Digraph(size);
          
        int v1 = 0;
        int v2 = 0;
        for(int i = 0; i < toSort.length; i++){
            for(int k = 0; k < toSort.length; k++){
            v1 = 0;
            v2 = 0;  
                if(Math.abs(toSort[i] - toSortOr[k]) < 0.001){                            
            
            // Adding edges to DAG 
            if(!digraph.contains(k/size,k%size)){
                        
                        v1 = k/size;
                        v2 = k%size;
                                          
                
            }
           digraph.addEdge(v1,v2);
           DirectedCycle finder = new DirectedCycle(digraph);
           if(finder.hasCycle()) {digraph.removeEdge(v1);
              
           }
                }
                                         
                           
        }
        }
        
        //StdOut.println(digraph);
        
        // Getting an ordering
        Topological topological = new Topological(digraph);
        
        for (int v : topological.order()) {
            StdOut.println((v));
        }
        int[] ordering = new int[size];
        counter = 0;
        for(int v:topological.order()){
            ordering[counter] = v;
            counter++;
        }
    }
}