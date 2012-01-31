import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;
import org.jsoup.nodes.Element;
import org.jsoup.select.Elements;

/* Written by Angie, Dan, Amy, Tiantian */

public class grabInfoBetter
{
    private static Iterable<Food> grab(String surl) 
    {
        In url = new In(surl);

        String htmlString = url.readAll();

        
        Document doc = Jsoup.parse(htmlString);
        Elements links = doc.select("a[href*=nutframe]");
        String str = "<a href=\"nutframe";
        int len = str.length();

        String kmpstring1 = "color: #";
        String kmpstring2 = "closeDescWin()\">";
        String kmpstring3 = "</a>";

        KMP kmp1 = new KMP(kmpstring1);
        KMP kmp2 = new KMP(kmpstring2);
        KMP kmp3 = new KMP(kmpstring3);

        Stack<Food> thelistOfood = new Stack<Food>();

        int i1, i2, i3;

        for (Element link : links)
        {
            String x = convert(link.toString(),len);
            String loc = link.ownText();
            System.out.println(loc);
            In nexturl = new In(x);
            String file = nexturl.readAll();
            String pat = "<div id=\"menusampmeals\">";
            int patlen = pat.length();
            assert (patlen > 0);
            KMP kmpmeals = new KMP(pat);
            int[] split = {-1, -1, -1};
            split[0] = kmpmeals.search(file);
            if (split[0] == file.length()) { 
                split[0] = -1;
                continue;
            }
            String[] strs;
            String middle = file.substring(split[0] + patlen);
            split[1] = kmpmeals.search(middle);
            if (split[1] == middle.length()) {
                split[1] = -1;
                strs = new String[1];
                strs[0] = file.substring(split[0]);
            }
            else {
                split[1] += (split[0]+patlen);
                String end = file.substring(split[1] + pat.length());
                split[2] = kmpmeals.search(end);
                if (split[2] == end.length()) {
                    strs = new String[2];
                    strs[0] = file.substring(split[0], split[1]);
                    strs[1] = file.substring(split[1]);
                    split[2] = -1;
                }
                else {
                    strs = new String[3];
                    split[2] += (split[1]+patlen);
                    strs[0] = file.substring(split[0], split[1]);
                    strs[1] = file.substring(split[1], split[2]);
                    strs[2] = file.substring(split[2]);
                }
            }
            
            for (String n : strs)
            {
                Document meal = Jsoup.parse(n);
                Elements name = meal.select("div[id*=menusampmeals]");
                String mealType = name.first().ownText();                
                
                Elements cleanedUpStuff = meal.select("div[class*=menusamprecipes]");


                for (Element y : cleanedUpStuff)
                {
                    String stringyness = y.toString();
                    i1 = kmp1.search(stringyness);
                    i2 = kmp2.search(stringyness);
                    i3 = kmp3.search(stringyness);
                    i1 = i1 + kmpstring1.length();
                    i2 = i2 + kmpstring2.length();

                    if (!isBlacklisted(stringyness.substring(i2, i3)) && !isBlacklisted(loc))
                    {
                        Food resultingFood = new Food(stringyness.substring(i1, i1+6), 
                                stringyness.substring(i2, i3), mealType, loc);
                        thelistOfood.push(resultingFood);
                    }
                }
            }
        }


        return thelistOfood;
    }

    private static boolean isBlacklisted(String test)
    {
        String[] blacklist = {"*", "Salad Selections", "Frist Favorites", "Every Day Grill", "Witherspoon's"};

        for (String cur : blacklist)
        {
            if (test.contains(cur))
                return true;
        }
        return false;
    }

    private static String convert(String orig, int beginIndex)
    {
        String head = "http://facilities.princeton.edu/dining/_Foodpro/";

        String change = head + "menuSamp" + orig.substring(beginIndex);

        char stop = '"';
        int memory = 0;
        for (int i = 0; i < change.length(); i++)
        {
            if (change.charAt(i) == stop)
            {
                memory = i;
                break;
            }
        }
        change = change.substring(0, memory);

        String[] comps = change.split("amp;");
        String result = "";

        for (String x : comps)
        {
            result = result + x;
        }

        return result;
    }

    /*private JSONArray convertJSON(Iterable<Food> input)
    {
        JSONArray result = new JSONArray();
        for (Food x : input)
            result.put(x);
        return result;
    }

    public JSONArray getJSONArraywithalltheresults()
    {
        return convertJSON(grab("http://facilities.princeton.edu/dining/_Foodpro/location.asp"));
    }*/

    public static void main(String[] args)
    {
        Iterable<Food> data = grab("http://facilities.princeton.edu/dining/_Foodpro/location.asp");
        Out output = new Out("readmeplease.txt");
        for (Food x : data)
        {
            output.println(x);
        }
    }
}