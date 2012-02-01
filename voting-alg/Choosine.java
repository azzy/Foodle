import java.sql.PreparedStatement;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;

public class Choosine {
    
    public static void main(String[] args) throws java.lang.ClassNotFoundException {
        Connection con = null;
        PreparedStatement pst = null;
        ResultSet rs = null;

	if (args.length < 1) {
	    System.err.println("Usage: Choosine pollid");
	    return;
	}

	int pollid;
	try {
	    pollid = Integer.parseInt(args[0]);
	} catch (Exception e) {
	    System.err.println("pollid must be an integer!");
	    return;
	}

	// To be initialized from mysql data
        int experts = 0;
	int size = 0;
	int length = 0;

        int[] choices = new int[0];
        double[] rank = new double[0];
        int[] id = new int[0];

       	Class.forName("com.mysql.jdbc.Driver");
	
        String url = "jdbc:mysql://localhost:3306/foodle"; // WHATEVER YOU WOULD WANT HERE
        String user = "foodle_user"; // OUR USER-ID
        String password = "cobs1_flammables"; // USER PASSWORD

        try {
            
            con = DriverManager.getConnection(url, user, password);


            pst = con.prepareStatement("SELECT * FROM polls WHERE pollid = " + pollid);
            rs = pst.executeQuery();
	    rs.first();
	    size = rs.getInt(2);
	    experts = rs.getInt(3);
	    rs.close();

            pst = con.prepareStatement("SELECT COUNT(*) FROM votes WHERE pollid = " + pollid);	    
	    rs = pst.executeQuery();
	    rs.first();
            length = rs.getInt(1);
	    rs.close();

            pst = con.prepareStatement("SELECT * FROM votes WHERE pollid = " + pollid);	    
	    rs = pst.executeQuery();

	    int counter = 0;
	    choices = new int[length];
	    rank = new double[length];
	    id = new int[length];

            while (rs.next()) {
                id[counter] = rs.getInt(3);
                choices[counter]=rs.getInt(4);
                rank[counter] = rs.getDouble(5);
		counter++;
            }

        } catch (SQLException ex) {
                Logger lgr = Logger.getLogger(Choosine.class.getName());
                lgr.log(Level.SEVERE, ex.getMessage(), ex);

        } finally {

            try {
                if (rs != null) {
                    rs.close();
                }
                if (pst != null) {
                    pst.close();
                }
                if (con != null) {
                    con.close();
                }

            } catch (SQLException ex) {
                Logger lgr = Logger.getLogger(Choosine.class.getName());
                lgr.log(Level.WARNING, ex.getMessage(), ex);
            }
        }
        
	//	System.err.println("Read all the data! size="+size+", length="+length+", experts="+experts);
        
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