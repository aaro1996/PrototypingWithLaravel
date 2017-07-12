public class HelloWorld {
	public static void main(String[] args) {
		int[] validCols = new int[7];
		for (char c : args[0].toCharArray()) {
			validCols[Character.getNumericValue(c)]++;
		}
		for(int i = 0; i < 7; i++) {
			if (validCols[i] < 6) {
				System.out.println(i+1);
				return;
			}
		}
	}
}