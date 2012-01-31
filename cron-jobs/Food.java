public class Food
{
    public String color;
    public String name;
    public String mealType;
    public String location;
    public int hash;

    public Food(String color, String name, String mealType, String location)
    {
        this.color = color;
        this.name = name;
        this.mealType = mealType;
        this.location = location;
        this.hash = name.hashCode();
    }

    public int hashCode()
    {
        return Math.abs(hash);
    }
    
    public String toString()
    {
        return location + ", " + name + ", " + color + ", " + mealType + ", " + hashCode();
    }
}