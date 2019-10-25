
# Cave Mapping Points Converter

Measuring points converter for the classic (paper) cave mapping    method.

**What is going on?**

In speleology, we have several methods for measuring geological objects, including: paperless - digital and classic.
This script is my suggestion for solving the problem of mapping measurement points on the plane and calculating the length of projected segments.

The length of the segment measured under any draft will be different after throwing it onto a flat sheet. You need to know the right formula to get the right proportion and perspective. In this case it will be:

    length * cos(deg2rad(inclination))

And this is only one parameter... so you can use this converter.


**How it's working?**

Based on the given data, the program performs calculations and returns the results in the form of the described **csv** file.

**How to use?**

Basic measurement data looks something like this:

    *data normal from to tape compass clino

	
	(Point_A | Point_B | length | compass |	inclination)
	   0	     1	     6.5	293	   -36
	   1	     2	     5.4	234	   -41
	   2	     3	     2.5	237	   -38
	   3	     4	     7.9	246	   -33

	*end
All you have to do is enter a table of points:

    $points = new PointsCollection([
        0 => new Point(6.5, 293, -36),
        1 => new Point(5.4, 234, -41),
        2 => new Point(2.5, 237, -38),
        3 => new Point(7.9, 246, -33),
    ]);
That's all - the results will be downloaded as csv.

 
**Nearest TODO in the future:**

 - The ability to add points in random order.
 - Import .svx files.

This will continue to be developed.

