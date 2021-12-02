<?php
/**
 * Test file for confirming liturgical year logic.
 *
 * @package canonlaw/what-year-is it
 */

use PHPUnit\Framework\TestCase;

/**
 * Testing class for liturgical year.
 */
final class AppTest extends TestCase
{
	/**
	 * Tests that the logic returns a known year.
	 *
	 * @param string $year Year for test.
	 * @param string $month Month to test.
	 * @param string $day Day to test.
	 * @param string $expected Expected liturgical year value in Sunday.Weekday format, e.g. A.1.
	 *
	 * @dataProvider get_known_years
	 * @covers ::getLiturgicalYearNumbers()
	 */
	public function test_liturgical_years( string $year, string $month, string $day, string $expected ): void
	{
		$this->assertSame( getLiturgicalYearNumbers( $year, $month, $day ), $expected );
	}

	/**
	 * Tests the logic regarding the end of the calendar year to confirm it pushes to the proper year.
	 *
	 * @param string $year Year for test.
	 * @param string $month Month for test.
	 * @param string $day Day for test.
	 * @param bool $expected If it is the next liturgical year.
	 *
	 * @dataProvider get_known_new_lit_years
	 * @covers ::newLiturgicalYearAD()
	 */
	public function test_next_liturgical_year( string $year, string $month, string $day, bool $expected ): void
	{
		$this->assertSame( newLiturgicalYearAD( $year, $month, $day ), $expected );
	}

	/**
	 * Tests the logic regarding the first Sunday of Advent based on known data.
	 *
	 * @param string $year Year for test.
	 * @param string $expected First Sunday of Advent.
	 *
	 * @dataProvider get_known_first_sunday_advent
	 * @covers ::getFirstSundayOfAdvent()
	 */
	public function test_first_sunday_advent( string $year, string $expected ): void
	{
		$this->assertSame( getFirstSundayOfAdvent( $year ), $expected );
	}

	/**
	 * Helper to get known years.
	 */
	public function get_known_years(): array
	{
		return array(
			'year 2022 is C.2' => array(
				'2022', '01', '01', 'C.2'
			),
			'year 2023 is A.1' => array(
				'2023', '01', '01', 'A.1'
			),
			'year 2024 is B.2' => array(
				'2024', '01', '01', 'B.2'
			),
			'year 2025 is C.1' => array(
				'2025', '01', '01', 'C.1'
			),
			'year 2026 is A.2' => array(
				'2026', '01', '01', 'A.2'
			),
			'year 2027 is B.1' => array(
				'2027', '01', '01', 'B.1'
			),
		);
	}

	/**
	 * Helper to get known dates relative to new liturgical year.
	 */
	public function get_known_new_lit_years(): array
	{
		return array(
			'October 1st is never in Advent' => array(
				'2022', '10', '01', false
			),
			'December 25th is always in the new year' => array(
				'2023', '12', '25', true
			),
			array( '2020', '11', '29', true ),
			array( '2020', '11', '28', false ),
			array( '2021', '11', '28', true ),
			array( '2021', '11', '27', false ),
			array( '2023', '12', '03', true ),
			array( '2023', '12', '02', false ),
		);
	}

	/**
	 * Helper to get known First Sundays of Advent.
	 */
	public function get_known_first_sunday_advent(): array
	{
		return array(
			array( '2020', 'November 29, 2020' ),
			array( '2021', 'November 28, 2021' ),
			array( '2022', 'November 27, 2022' ),
			array( '2023', 'December 3, 2023' ),
		);
	}
}


