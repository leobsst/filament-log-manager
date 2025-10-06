<?php

return [
    // =======================================
    // LOG EDITOR INTERFACE
    // =======================================
    /**
     * Maximum amount of lines that editor will render.
     */
    'max_lines' => 100,

    /**
     * Minimum amount of lines that editor will render.
     */
    'min_lines' => 10,

    /**
     * Editor font size.
     */
    'font_size' => 12,

    // =======================================
    // FILE MANAGEMENT
    // =======================================
    /**
     * Set max file size reader
     * Default 5242880 = 5 MB
     */
    'max_file_size' => 5242880,

    // =======================================
    // PAGE FORM
    // =======================================
    /**
     * Limit the number of results returned from the search.
     * If set to -1 or null or 0 there is no limit.
     */
    'limit' => -1,
];
