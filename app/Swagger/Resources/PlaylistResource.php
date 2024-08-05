<?php

namespace App\Swagger\Resources;

/**
 * @OA\Schema(
 *     title="PlaylistResource",
 *     description="Playlist Resource",
 *     @OA\Xml(
 *         name="PlaylistResource"
 *     )
 * )
 */
class PlaylistResource
{
    /**
     * @OA\Property(
     *      title="playlist",
     *      description="url of spotify music",
     *      example="https://open.spotify.com/playlist/any"
     * )
     *
     * @var string
     */
    public $playlist;

    /**
     * @OA\Property(
     *      title="category",
     *      description="category of music",
     *       example="'pop', 'classic', 'rock'"
     * )
     *
     * @var string
     */
    public $category;

    /**
     * @OA\Property(
     *      title="temperature",
     *      description="temperature of city",
     *      example="23"
     * )
     *
     * @var int
     */
    public $temperature;
}
