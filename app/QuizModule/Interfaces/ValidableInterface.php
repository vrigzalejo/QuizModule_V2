<?php namespace QuizModule\Interfaces;

interface ValidableInterface
{
    /**
     * Add data to validation against
     *
     * @param array
     * @return 
     *      */
    public function with($input = []);

    /**
     * Test if validation passes
     *
     * @return boolean
     */
    public function passes();

    /**
     * Retrieve validation errors
     *
     * @return array
     */
    public function errors();

}
