<?hh
/*
 *  Copyright (c) 2004-present, Facebook, Inc.
 *  All rights reserved.
 *
 *  This source code is licensed under the MIT license found in the
 *  LICENSE file in the root directory of this source tree.
 *
 */

namespace HH\Lib\_Private\_File;

use namespace HH\Lib\{File, IO};
use namespace HH\Lib\_Private\_IO;

final class DisposableFileWriteHandle
  extends DisposableFileHandle<File\CloseableWriteHandle>
  implements File\DisposableWriteHandle {
  use _IO\DisposableWriteHandleWrapperTrait<File\CloseableWriteHandle>;
}
