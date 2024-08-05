<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="OpenApiDocumentation",
 *      description="OpenApi description",
 *      @OA\Contact(
 *          email="conato@maiky.dev"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 *
 * /**
 * @OA\PathItem(path="/api/v1")
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Doc API Server"
 * )

 *
 * @OA\Tag(
 *     name="Weather",
 *     description="API Endpoints of Projects"
 * )
 *
 **/
abstract class Controller
{
    //
}
